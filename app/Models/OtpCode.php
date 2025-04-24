<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $code
 * @property $user_id
 * @property $phone
 * @property $fail
 * @property $ip
 * @property $is_logged_in
 * @property $session_id
 * @property $channel
 * @property $data
 * @property $remember
 * @property $expire_at
 */
class OtpCode extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];

}
