<?php


namespace App\Panel\UiHandler;



class XRelation
{
  public bool $manyToMany = false;
  public ?string $belongTo = null;
  public ?string $targetRelationClass = null;
  public ?string $relationTable = null;
}

