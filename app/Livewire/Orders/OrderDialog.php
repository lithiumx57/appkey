<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderDialog extends Component
{
  public int $mode = 0;
  public Order|null $order = null;

  public string $class = "";
  public int $zIndex = 0;


  public function closeMessage(): void
  {
    $this->order = null;
    $this->class = "";
  }

  protected $listeners = [
    "show-order-dialog" => "show",
    "refresh" => '$refresh',
    "order-status-changed" => '$refresh'
  ];


  public function mount(): void
  {
    $this->show(7);
  }

  public function show($id): void
  {
    $this->order = Order::find($id);
    $this->class = "active";
  }

  public function showOrderStatusDialog($id): void
  {
    $this->dispatch("show-order-status-dialog", $id);
  }


  public function render()
  {
    return view('livewire.orders.order-dialog');
  }


  public function showMessageDialog():void
  {
    $this->dispatch("show-model-log-dialog",[
      "model" => Order::class,
      "modelId" => $this->order->id,
      "zIndex" => $this->zIndex+1,
    ]);
  }
}
