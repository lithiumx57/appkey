<?php

namespace App\Panel\UiHandler\Elements\Attributes;

trait RelationAttributes
{
  function conditions($value)
  {
    $this->query->conditions = $value;
    return $this;
  }

  public function bigData()
  {
    $this->view->bigData = true;
    return $this;
  }


}
