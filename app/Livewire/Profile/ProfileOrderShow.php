<?php

namespace App\Livewire\Profile;

use App\Models\Order;
use Livewire\Component;

class ProfileOrderShow extends Component
{
  public $orderId = -1;
  public $findOrder = true;
  public $order = null;

  public function mount()
  {
    $order = Order::find($this->orderId);
    if (!$order) {
      $this->findOrder=false;
      return;
    }

    if ($order->user_id != auth()->user()->id) {
      $this->findOrder=false;
      return;
    }
    $this->order = $order;

  }

  public function render()
  {
    return view('livewire.profile.profile-order-show');
  }
}
