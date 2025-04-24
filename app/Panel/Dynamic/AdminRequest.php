<?php

namespace App\Panel\Dynamic;

use App\Panel\Requests\XRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest {
  public static ?string $model = null;

  public function authorize():bool
  {
    return true;
  }

  public function rules():array
  {
    return XRequest::getRules();
  }

  public function attributes():array
  {
    return XRequest::getAttributes();
  }

}
