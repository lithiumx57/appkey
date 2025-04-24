<?php

namespace App\Livewire\Admin\Tools;

use App\Models\ModelLog;
use Illuminate\Support\Str;
use Livewire\Component;

class AddMessage extends Component
{


  public $model = "";
  public $modelId = -1;
  public $record = null;
  public string $class = "";
  public int $zIndex = 0;
  public string $message = "";

  public int $mode = 0;


  protected $listeners = [
    "add-message-dialog" => "show",
    "save-message" => "saveMessage",
  ];


  public function closeDialog(): void
  {
    $this->class = "";
  }


  public function saveMessage()
  {
    $message = $this->message;
    if (!$message || strlen($message) < 4) {
      wire()->alert()->warning($this, "متن پیام کوتاه است");
      return;
    }

    ModelLog::createLog($this->model, $this->modelId, $this->message, $this->mode);
    $this->dispatch("message-created", $this->model, $this->modelId, $this->message);
    $this->class = "";
    $this->message = '';
    wire()->alert()->success($this, "پیام با موفقیت ثبت شد");
  }


  public function show($model, $modelId, $zIndex = 0, $mode = 0)
  {
    $this->model = $model;
    $this->mode = $mode;
    $this->modelId = $modelId;
    $this->zIndex = $zIndex + 2;
    $this->class = "active";
    $this->record = $model::find($modelId);
//    createSelectFields($this, ["#user-select"]);


//    LogCreator::release(Order::class, "دیالگ ایجاد پیام را برای سفارش " . "%order$orderId%order" . " باز کرد", Log::MODE_TEMP);

  }

  public function dehydrate()
  {
//    createSelectFields($this, ["#user-select"]);

  }

  public function render()
  {
    return view('livewire.admin.tools.add-messages');
  }
}
