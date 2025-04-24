<?php

namespace App\Infrastructure\Auth\Strategies;

use App\Infrastructure\ApiResponse\ApiResponseStatuses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Jwt
{

  public function login()
  {
    $validator = Validator::make(request()->all(), [
      'username' => 'required|string|max:100',
      'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) return apiResponse()->validationError(buildValidationErrors($validator->errors())[0]);
    $credentials = request()->only('username', 'password');
    $token = auth("api")->attempt($credentials);
    if (!$token) return apiResponse()->abortWithMessage(ApiResponseStatuses::STATUS_VALIDATION_ERROR, "کاربری با این مشخصات یافت نشد");
    return $this->authSuccess($token);
  }


  public static function loginWithUser(User $user)
  {
    $credentials = [
      "username" => $user->username,
      "password" => $user->username
    ];

    $token = Auth::attempt($credentials);
    if (!$token) {
      return apiResponse()->unAuthorized();
    }

    return self::authSuccess($token);
  }

  private static function authSuccess($token)
  {

    return [
      'authorisation' => [
        'token' => $token,
        'type' => 'bearer',
      ],
      "user" => self::castUser()
    ];
  }


  public static function register()
  {
    $request = request();
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:8|max:100',
      'username' => 'required|string|max:100|unique:users',
      'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) return apiResponse()->validationError(buildErrors($validator->errors())[0]);
    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
    $credentials = $request->only('email', 'password');
    $token = auth("api")->attempt($credentials);
    return self::authSuccess($token);
  }

  public static function logout()
  {
    auth("api")->logout();
    return apiResponse()->success();
  }

  public function me()
  {
    return apiResponse()->success($this->castUser());
  }


  public static function castUser(): array
  {
    $user = getUser();
    return [
      "id" => $user->id,
      "name" => trim($user->name . " " . $user->family),
      "username" => $user->username,
      "is_admin" => (bool)$user->is_admin,
      "avatar" => $user->getAvatar(),
      "wallet" => $user->wallet
    ];
  }

  public static function refresh()
  {
    return self::authSuccess(auth()->refresh());
  }
}
