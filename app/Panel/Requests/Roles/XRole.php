<?php


namespace App\Panel\Requests\Roles;


use App\Panel\helpers\ModelHelper;

class XRole {

  private string $result = "";

  public function init($row): array
  {
    $rules = $row['roles'];
    $name = $row['name'];

    if ($rules['patchNotRequired'] && isPatchMethod())
      return [];


    if ($rules['postNotRequired'] && isPostMethod())
      return [];

    $this->initRequired($rules);
    $this->initMin($rules);
    $this->initmax($rules);
    $this->initEmail($rules);
    $this->initMimes($rules);
    $this->initNumeric($rules);
    $this->initImage($rules);
    $this->initUnique($rules, $name);

    if ($this->result != "") {
      return [
        $row['name'] => $this->result
      ];
    }
    return [];
  }

  private function initMin($row)
  {
    if ($row['min'])
      $this->result .= "min:" . $row['min'] . "|";
  }

  private function initUnique($row, $name)
  {
    if ($row['unique']) {
      if (isPatchMethod()) {
        $result = explode("/", request()->getRequestUri());
        $result = $result[count($result) - 1];
        $object = ModelHelper::getRecord($result);
        $result = $object->$name === getXRequest($name);
        if ($result) {
          return;
        }
      }
      $this->result .= "unique:" . $row['unique'] . "|";
    }
  }

  private function initMimes($row)
  {
    if ($row['mimes']) {
      $this->result .= "mimes:";
      $i = 0;
      foreach ($row['mimes'] as $value) {
        $i++;
        $this->result .= $value;
        if (count($row['mimes']) > $i)
          $this->result .= ",";
      }
    }
  }

  private function initEmail($row)
  {
    if ($row['email']) {
      $this->result .= "email|";
    }
  }

  private function initImage($row)
  {
    if ($row['image'])
      $this->result .= "image|";
  }


  private function initNumeric($row)
  {
    if ($row['numeric'])
      $this->result .= "numeric|";
  }


  private function initRequired($row)
  {
    if (!$row['nullable'])
      $this->result .= "required|";
  }

  private function initmax($row)
  {
    if ($row['min'])
      $this->result .= "max:" . $row['max'] . "|";
  }


}
