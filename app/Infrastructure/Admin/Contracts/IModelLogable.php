<?php

namespace App\Infrastructure\Admin\Contracts;

use App\Models\ModelLog;

interface IModelLogable
{
  public function messageCreated(ModelLog $modelLog): void;
}
