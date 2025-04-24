<?php

namespace App\Livewire\Profile;

use App\Models\Order;
use Livewire\Component;

class ProfileOrders extends Component
{
  public function render()
  {
    $orders=Order::where("user_id",auth()->id())->paginate(10);
    return view('livewire.profile.profile-orders',compact("orders"));
  }
}
