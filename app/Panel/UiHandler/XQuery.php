<?php


namespace App\Panel\UiHandler;


class XQuery
{
  public ?string $model = null;
  public array $conditions = array();
  public string $primaryKey = "id";
  public array $renderFields = [];
  public string $foreignKey;
  public ?string $relation = null;
  public bool $hash = false;
}
