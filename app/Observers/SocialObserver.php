<?php

namespace App\Observers;

use App\Models\Social;
use App\Repositories\SocialRepository;

class SocialObserver
{
  public function creating(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  public function created(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  public function updating(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  public function updated(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  public function deleting(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  /**
   * Handle the Social "deleted" event.
   */
  public function deleted(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  /**
   * Handle the Social "restored" event.
   */
  public function restored(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }

  /**
   * Handle the Social "forceDeleted" event.
   */
  public function forceDeleted(Social $social): void
  {
    resolve(SocialRepository::class)->cacheData();
  }
}
