<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderStatusesDialog extends Component
{

  public $id = -1;
  public string $class = "";
  public int $mode = 0;
  public int $zIndex = 1;


  protected $listeners = [
    "show-order-status-dialog" => "show"
  ];


  public function closeDialog(): void
  {
    $this->class = "";
  }


  public function show($id)
  {
    $this->id = $id;
    $this->class = "active";
  }

  public function changeStatus($key): void
  {
    Order::find($this->id)->update(['status' => $key]);
    wire()->alert()->success($this, "به روز رسانی با موفقیت انجام شد");
    $this->dispatch("order-status-changed");
    $this->closeDialog();
  }


  public function render()
  {
    return view('livewire.admin.orders.order-statuses-dialog');
  }
}
