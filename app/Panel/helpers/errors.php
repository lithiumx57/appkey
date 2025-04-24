<?php

use App\Panel\Exceptions\XPanelException;


/**
 * @throws XPanelException
 */
function errorIfTableNotFoundColumn($model, $sortField): void
{
  $table = $model::getModelTable();
  if (!hasArrayIndex($model::getAllFillAbles(), $sortField)) {
    throw new XPanelException("وجود ندارد $table جدول $sortField  فیلد ");
  }
}

/**
 * @throws XPanelException
 */
function throwErrorIfMethodNotExistsInClass($model, $method, $type = "instance"): void
{
  try {
    $rc = new ReflectionClass($model);
    $model = $rc->name;
    if ($rc->hasMethod($method)) {
      $result = $rc->getMethod($method);

      if ($type != "both") {
        if ($type == "libs") {
          if (!$result->isStatic()) {
            throw new XPanelException(" باید به صورت استاتیک باشد $model  در کلاس  $method متد ");
          }
        } else {
          if ($result->isStatic()) {
            throw new XPanelException(" نباید به صورت استاتیک باشد $model  در کلاس  $method متد ");
          }
        }
      }
    } else {
      throw new XPanelException(" وجود ندارد $model  در کلاس  $method متد ");
    }
  } catch (ReflectionException) {
  }
}

/**
 * @throws XPanelException
 */
function xError($error)
{
  throw new XPanelException($error);
}
