<?php

namespace App\Infrastructure\Admin\Helpers;

use App\Models\Order;

class ModelLogHelper
{
  public static function showDialog($component, $model, $modelId, $mode = 0): void
  {
    $component->dispatch("show-model-log-dialog", [
      "model" => $model,
      "modelId" => $modelId,
      "mode" => $mode
    ]);
  }
}
