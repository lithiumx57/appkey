<?php

namespace App\Panel\views\Livewire\Classes\Notifications;

use App\Panel\Models\Notification;
use Livewire\Component;

class NotificationsDialog extends Component
{
  public bool $show = false;

  protected $listeners = [
    "show-notification-dialog" => "show"
  ];


  public function dismiss()
  {
    $this->show = false;
  }

  public function show()
  {
    $this->dispatch("dialog-show");
    $this->show = true;
  }

  public function seen($id)
  {
    $notification = Notification::find($id);
    $notification->switchSeen();
    wire()->alert()->success($this);
    $this->emitSelf("refresh");
  }

  public function render()
  {
    return view('livewire.views.notifications.notifications-dialog');
  }
}
