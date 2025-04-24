<?php

namespace App\Livewire\Admin\Panel;

use App\Helpers\CacheHelper\HomePage;
use App\Repositories\BlogRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Livewire\Component;

class RegeneratePart extends Component
{
  public function render()
  {
    return view('livewire.admin.panel.regenerate-part');
  }

  public function regenerate($key): void
  {
    if ($key == "home") {
      HomePage::regenerateData();
    } else if ($key == "blog") {
      app(BlogRepositoryInterface::class)->regenerateHomePage();
    }

    wire()->alert()->success($this, "عملیات با موفقیت انجام شد");
  }
}
