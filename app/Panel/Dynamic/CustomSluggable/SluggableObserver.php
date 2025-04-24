<?php

namespace App\Panel\Dynamic\CustomSluggable;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;


/**
 * Class SluggableObserver
 *
 * @package Cviebrock\EloquentSluggable
 */
class SluggableObserver
{

  public const SAVING = 'saving';

  public const SAVED = 'saved';

  private $slugService;

  private $events;

  public function __construct(SlugService $slugService, Dispatcher $events)
  {
    $this->slugService = $slugService;
    $this->events = $events;
  }

  public function saving(Model $model)
  {
    if ($model->sluggableEvent() !== self::SAVING) {
      return;
    }

    $this->generateSlug($model, 'saving');
  }

  public function saved(Model $model)
  {
    if ($model->sluggableEvent() !== self::SAVED) {
      return;
    }
    if ($this->generateSlug($model, 'saved')) {
      return $model->saveQuietly();
    }
  }

  protected function generateSlug(Model $model, string $event): bool
  {
    if ($this->fireSluggingEvent($model, $event) === false) {
      return false;
    }
    $wasSlugged = $this->slugService->slug($model);
    $this->fireSluggedEvent($model, $wasSlugged);
    return $wasSlugged;
  }

  protected function fireSluggingEvent(Model $model, string $event): ?bool
  {
    return $this->events->until('eloquent.slugging: ' . get_class($model), [$model, $event]);
  }

  protected function fireSluggedEvent(Model $model, string $status): void
  {
    $this->events->dispatch('eloquent.slugged: ' . get_class($model), [$model, $status]);
  }
}
