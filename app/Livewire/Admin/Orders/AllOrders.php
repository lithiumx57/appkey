<?php

namespace App\Livewire\Admin\Orders;

use App\Infrastructure\Admin\Helpers\ModelLogHelper;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrders extends Component
{
  use WithPagination;

  protected string $paginationTheme = "bootstrap";

  protected $listeners = [
    "message-created" => '$refresh',
  ];

  public function render()
  {
    $orders = Order::latest()->paginate(10);
    return view('livewire.admin.orders.all-orders', compact("orders"));
  }

  public function showOrder($id)
  {
    $this->dispatch("show-order-dialog",$id);
  }

  public function showOrderStatusDialog($id)
  {
    $this->dispatch("show-order-status-dialog", $id);
  }


  public function showMessageDialog($orderId): void
  {
    ModelLogHelper::showDialog($this, Order::class, $orderId);
  }

}
