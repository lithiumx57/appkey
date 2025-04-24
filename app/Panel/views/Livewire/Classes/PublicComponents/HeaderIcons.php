<?php

namespace App\Panel\views\Livewire\Classes\PublicComponents;

use App\Panel\views\Livewire\Classes\Notifications\ProfileMain;
use Livewire\Component;

class HeaderIcons extends Component
{

  public $notificationsCount = 0;

  protected $listeners = [
    'update-notifications-count' => 'updateNotificationsCount',
  ];

  public function mount()
  {
    $this->updateNotificationsCount();
  }

  public function showBackgroundDialog()
  {
    $this->dispatch("show-background-dialog");
  }


  public function updateNotificationsCount()
  {
    $this->notificationsCount = \App\Panel\Models\Notification::getNotificationCount();
  }



  public function showNotificationDialog()
  {
    $this->dispatch("show-notification-dialog");
  }

  public function render()
  {
    return view('livewire.views.public-components.header-icons');
  }
}
