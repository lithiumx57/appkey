<?php

namespace App\Panel\Dynamic\CustomSluggable;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait XSluggable
{

  public static function bootSluggable(): void
  {
    static::observe(app(SluggableObserver::class));
  }

  public static function slugging($callback): void
  {
    static::registerModelEvent('slugging', $callback);
  }

  public static function slugged($callback): void
  {
    static::registerModelEvent('slugged', $callback);
  }

  public function replicate(?array $except = null)
  {
    $instance = parent::replicate($except);
    (new SlugService())->slug($instance, true);

    return $instance;
  }

  public function sluggableEvent(): string
  {
    return SluggableObserver::SAVING;
  }

  public function scopeFindSimilarSlugs(Builder $query, string $attribute, array $config, string $slug): Builder
  {
    $separator = $config['separator'];

    return $query->where(function(Builder $q) use ($attribute, $slug, $separator) {
      $q->where($attribute, '=', $slug)
        ->orWhere($attribute, 'LIKE', $slug . $separator . '%');
    });
  }

  abstract public function sluggable(): array;


  public function scopeWithUniqueSlugConstraints(
    Builder $query,
    Model $model,
    string $attribute,
    array $config,
    string $slug
  ): Builder
  {
    return $query;
  }
}


