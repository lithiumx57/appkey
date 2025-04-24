<?php

namespace App\Panel\Dynamic\CustomSluggable;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class SlugService
 *
 * @package Cviebrock\EloquentSluggable\Services
 */
class SlugService
{

  private $config;
  protected $model;

  public function __construct()
  {
    $this->config = XSluggableConfig::get();
  }

  public function slug(Model $model, bool $force = false): bool
  {
    $this->setModel($model);

    $attributes = [];

    foreach ($this->model->sluggable() as $attribute => $config) {
      if (is_numeric($attribute)) {
        $attribute = $config;
        $config = $this->getConfiguration();
      } else {
        $config = $this->getConfiguration($config);
      }

      $slug = $this->buildSlug($attribute, $config, $force);

      if ($slug !== null) {
        $this->model->setAttribute($attribute, $slug);
        $attributes[] = $attribute;
      }
    }

    return $this->model->isDirty($attributes);
  }


  public function getConfiguration(array $overrides = []): array
  {
    $defaultConfig = config('sluggable', []);

    return array_merge($defaultConfig, $overrides);
  }


  public function buildSlug(string $attribute, array $config = null, bool $force = false): ?string
  {
    if (!$config) $config = XSluggableConfig::get();
    $slug = $this->model->getAttribute($attribute);

    if ($force || $this->needsSlugging($attribute, $config)) {
      $source = $this->getSlugSource($config['source']);

      if ($source || is_numeric($source)) {
        $slug = $this->generateSlug($source, $config, $attribute);
        $slug = $this->validateSlug($slug, $config, $attribute);
        $slug = $this->makeSlugUnique($slug, $config, $attribute);
      }
    }

    return $slug;
  }


  protected function needsSlugging(string $attribute, array $config): bool
  {
    $value = $this->model->getAttributeValue($attribute);

    if (
      $config['onUpdate'] === true ||
      $value === null ||
      trim($value) === ''
    ) {
      return true;
    }

    if ($this->model->isDirty($attribute)) {
      return false;
    }

    return (!$this->model->exists);
  }


  protected function getSlugSource($from): string
  {
    if (is_null($from)) {
      return $this->model->__toString();
    }

    $sourceStrings = array_map(function ($key) {
      $value = data_get($this->model, $key, $this->model->getAttribute($key));
      if (is_bool($value)) {
        $value = (int)$value;
      }

      return $value;
    }, (array)$from);

    return implode(' ', $sourceStrings);
  }


  protected function generateSlug(string $source, array|null $config = null, string $attribute): string
  {
    $separator = $this->config['separator'];
    $method = $this->config['method'];
    $maxLength = $this->config['maxLength'];
    $maxLengthKeepWords = $this->config['maxLengthKeepWords'];

    if ($method === null) {
      $slugEngine = $this->getSlugEngine($attribute, $config);
      $slug = $slugEngine->slugify($source, $separator);
    } elseif (is_callable($method)) {
      $slug = $method($source, $separator);
    } else {
      throw new \UnexpectedValueException('Sluggable "method" for ' . get_class($this->model) . ':' . $attribute . ' is not callable nor null.');
    }

    $len = mb_strlen($slug);
    if (is_string($slug) && $maxLength && $len > $maxLength) {
      $reverseOffset = $maxLength - $len;
      $lastSeparatorPos = mb_strrpos($slug, $separator, $reverseOffset);
      if ($maxLengthKeepWords && $lastSeparatorPos !== false) {
        $slug = mb_substr($slug, 0, $lastSeparatorPos);
      } else {
        $slug = trim(mb_substr($slug, 0, $maxLength), $separator);
      }
    }

    return $slug;
  }


  protected function getSlugEngine(string $attribute, array $config): Slugify
  {
    static $slugEngines = [];

    $key = get_class($this->model) . '.' . $attribute;

    if (!array_key_exists($key, $slugEngines)) {
      $engine = new Slugify($config['slugEngineOptions']);
      $engine = $this->model->customizeSlugEngine($engine, $attribute);

      $slugEngines[$key] = $engine;
    }

    return $slugEngines[$key];
  }


  protected function validateSlug(string $slug, array $config, string $attribute): string
  {
    $separator = $this->config['separator'];
    $reserved = $this->config['reserved'];

    if ($reserved === null) {
      return $slug;
    }

    // check for reserved names
    if ($reserved instanceof \Closure) {
      $reserved = $reserved($this->model);
    }

    if (is_array($reserved)) {
      if (in_array($slug, $reserved)) {
        $method = $config['uniqueSuffix'];
        $firstSuffix = $config['firstUniqueSuffix'];

        if ($method === null) {
          $suffix = $this->generateSuffix($slug, $separator, collect($reserved), $firstSuffix);
        } elseif (is_callable($method)) {
          $suffix = $method($slug, $separator, collect($reserved), $firstSuffix);
        } else {
          throw new \UnexpectedValueException('Sluggable "uniqueSuffix" for ' . get_class($this->model) . ':' . $attribute . ' is not null, or a closure.');
        }

        return $slug . $separator . $suffix;
      }

      return $slug;
    }

    throw new \UnexpectedValueException('Sluggable "reserved" for ' . get_class($this->model) . ':' . $attribute . ' is not null, an array, or a closure that returns null/array.');
  }


  protected function makeSlugUnique(string $slug, array $config, string $attribute): string
  {
    if (!isset($config['unique'])) {
      $config = $this->config;
    }
    if (!$config['unique']) {
      return $slug;
    }

    $separator = $config['separator'];

    $list = $this->getExistingSlugs($slug, $attribute, $config);

    if (
      $list->count() === 0 ||
      $list->contains($slug) === false
    ) {
      return $slug;
    }

    if ($list->has($this->model->getKey())) {
      $currentSlug = $list->get($this->model->getKey());

      if (
        $currentSlug === $slug ||
        !$slug || strpos($currentSlug, $slug) === 0
      ) {
        return $currentSlug;
      }
    }

    if (!isset($config['uniqueSuffix'])) {
      $config = $this->config;
    }
    if (!isset($config['firstUniqueSuffix'])) {
      $config = $this->config;
    }

    $method = $config['uniqueSuffix'];
    $firstSuffix = $config['firstUniqueSuffix'];

    if ($method === null) {
      $suffix = $this->generateSuffix($slug, $separator, $list, $firstSuffix);
    } elseif (is_callable($method)) {
      $suffix = $method($slug, $separator, $list, $firstSuffix);
    } else {
      throw new \UnexpectedValueException('Sluggable "uniqueSuffix" for ' . get_class($this->model) . ':' . $attribute . ' is not null, or a closure.');
    }

    return $slug . $separator . $suffix;
  }


  protected function generateSuffix(string $slug, string $separator, Collection $list, $firstSuffix): string
  {
    $len = strlen($slug . $separator);

    // If the slug already exists, but belongs to
    // our model, return the current suffix.
    if ($list->search($slug) === $this->model->getKey()) {
      $suffix = explode($separator, $slug);

      return end($suffix);
    }

    $list->transform(function ($value, $key) use ($len) {
      return (int)substr($value, $len);
    });

    $max = $list->max();

    return (string)($max === 0 ? $firstSuffix : $max + 1);
  }


  protected function getExistingSlugs(string $slug, string $attribute, array $config): Collection
  {
    if (!isset($config['includeTrashed'])) {
      $config = $this->config;
    }

    $includeTrashed = $config['includeTrashed'];

    $query = $this->model->newQuery()
      ->findSimilarSlugs($attribute, $config, $slug);

    // use the model scope to find similar slugs
    $query->withUniqueSlugConstraints($this->model, $attribute, $config, $slug);

    // include trashed models if required
    if ($includeTrashed && $this->usesSoftDeleting()) {
      $query->withTrashed();
    }

    // get the list of all matching slugs
    $results = $query
      ->withoutEagerLoads()
      ->select([$attribute, $this->model->getQualifiedKeyName()])
      ->get()
      ->toBase();

    // key the results and return
    return $results->pluck($attribute, $this->model->getKeyName());
  }


  protected function usesSoftDeleting(): bool
  {
    return method_exists($this->model, 'bootSoftDeletes');
  }


  public static function createSlug($model, string $attribute, string $fromString, ?array $config = null): string
  {
    if (is_string($model)) {
      $model = new $model;
    }
    /** @var static $instance */
    $instance = (new static())->setModel($model);

    if ($config === null) {
      $config = Arr::get($model->sluggable(), $attribute);
      if ($config === null) {
        $modelClass = get_class($model);
        throw new \InvalidArgumentException("Argument 2 passed to SlugService::createSlug ['{$attribute}'] is not a valid slug attribute for model {$modelClass}.");
      }
    } elseif (!is_array($config)) {
      throw new \UnexpectedValueException('SlugService::createSlug expects an array or null as the fourth argument; ' . gettype($config) . ' given.');
    }

    $config = $instance->getConfiguration($config);

    $slug = $instance->generateSlug($fromString, $config, $attribute);
    $slug = $instance->validateSlug($slug, $config, $attribute);
    $slug = $instance->makeSlugUnique($slug, $config, $attribute);

    return $slug;
  }


  public function setModel(Model $model): self
  {
    $this->model = $model;

    return $this;
  }
}
