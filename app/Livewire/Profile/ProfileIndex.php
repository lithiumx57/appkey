<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class ProfileIndex extends Component
{

  public string $path = "/";
  public string|null $p1 = null;
  public string|null $p2 = null;
  public string|null $p3 = null;

  protected $listeners = [
    "profile-navigation-changed" => "changePath"
  ];

  public function mount(): void
  {
    if ($this->path == "" || $this->path == null) {
      $this->path = "/";
    }
  }


  public function changePath($data): void
  {
    if (strpos($data, "{") > -1) {
      $data = json_decode($data, true);
      $this->path = @$data["path"];
      $this->p1 = @$data["p1"];
      $this->p2 = @$data["p2"];
      $this->p3 = @$data["p3"];
    } else {
      $this->path = $data;
    }
  }

  public function render()
  {
    return view('livewire.profile.profile-index');
  }
}
