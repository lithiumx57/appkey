<?php

namespace App\Livewire\Admin\Tools;

use App\Models\ModelLog;
use Illuminate\Support\Collection;
use Livewire\Component;

class AllMessages extends Component
{
  public ?string $model = "";
  public int $modelId = -1;
  public int $mode = 0;
  public Collection $records;

  public string $class = "";
  public $record = null;
  public int $zIndex = 0;


  public function closeMessage(): void
  {
    $this->model = "";
    $this->class = "";
  }

  protected $listeners = [
    "show-model-log-dialog" => "show",
    "refresh" => '$refresh',
    'message-created' => "messageCreated"
  ];


  public function messageCreated(): void
  {
    $this->initMessages();
  }

  public function show($data): void
  {
    $model = $data["model"];
    $modelId = $data["modelId"];
    $this->zIndex = @$data["zIndex"] ?? 99;
    $this->record = $model::find($modelId);
    $this->model = $model;
    $this->modelId = $modelId;
    $this->class = "active";
    $this->initMessages();
  }

  private function initMessages(): void
  {
    $this->records = ModelLog::where("model", $this->model)->where("model_id", $this->modelId)->latest()->get();
  }


  public function createNewMessage(): void
  {
    $this->dispatch('add-message-dialog', $this->model, $this->modelId, $this->zIndex + 1, $this->mode);
  }

  public function render()
  {
    return view('livewire.admin.tools.all-messages');
  }
}
