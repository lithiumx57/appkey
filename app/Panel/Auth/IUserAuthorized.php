<?php


namespace App\Panel\Auth;


use App\Panel\Dynamic\LiModel;

interface IUserAuthorized
{
  public static function releaseGates();
  public static function checkUserPermissions(LiModel $model);

}