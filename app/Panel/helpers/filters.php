<?php

function generateMethod($filter, $return)
{
  if (isPostMethod() && $filter->role->postNotRequired) {
    return null;
  }

  if (isPatchMethod() && $filter->role->patchNotRequired) {
    return null;
  }
  return $return;
}

function getMaxFilter($filter)
{
  $filterMax = $filter->role->max;
  if ($filterMax == null || !is_numeric($filterMax)) return null;
  return generateMethod($filter, "max:$filterMax|");
}

function getDateFilter($filter)
{
  $dateFiled = $filter->role->date;
  if ($dateFiled == null || !$dateFiled) return null;
  return generateMethod($filter, "date|");
}

function getMimesFilter($filter)
{
  $mimesFilter = $filter->role->mimes;
  if ($mimesFilter == null || !is_array($mimesFilter) || count($mimesFilter) == 0) return null;
  return generateMethod($filter, "mimes:" . implode(",", $mimesFilter) . "|");
}

function getImageFilter($filter)
{
  $imageFilter = $filter->role->image;
  if ($imageFilter == null) return null;

  return generateMethod($filter, "image|");
}


function getUniqueFilter($filter)
{
  $uniqueFilter = $filter->role->unique;
  if ($uniqueFilter == null) return null;

  $model = getXRequest("xModel");

  if (isPostMethod() && $filter->role->postNotRequired) {
    return null;
  }

  if (isPatchMethod() && $filter->role->patchNotRequired) {
    return null;
  }

  $fillAble = $filter->view->fillAble;

  if (isPatchMethod()) {
    $object = $model::where([
      $fillAble => getXRequest($fillAble)
    ])->first();

    $id = getXRequest("object_id");
    $oldObject = $model::find($id);

    if ($object instanceof $model && $oldObject->$fillAble != $object->$fillAble) {
      return "unique:" . $uniqueFilter . "|";
    } else {
      return null;
    }
  }
  return "unique:" . $uniqueFilter . "|";
}


function getEmailFilter($filter)
{
  $emailFilter = $filter->role->email;
  if ($emailFilter == null || !$emailFilter) return null;
  return generateMethod($filter, "email|");
}

function getMinFilter($filter)
{
  $minFilter = $filter->role->min;
  if ($minFilter == null || !is_numeric($minFilter)) return null;
  return generateMethod($filter, "min:$minFilter|");
}

function getRequiredFilter($filter)
{
  $requiredFilter = $filter->role->nullable;
  if ($requiredFilter != null || $requiredFilter) return null;
  return generateMethod($filter, "required|");
}

function escapeRules($roles)
{
  $records = [];
  foreach ($roles as $key => $role) {
    if ($role == null || $role == "") continue;
    $records[$key] = $role;
  }

  return $records;
}
