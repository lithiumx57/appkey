<?php


namespace App\Panel\UiHandler\Elements;


use Mockery\Exception;
use ReflectionClass;

class XTd extends Element
{

  public function getViewer($record): ?string
  {
    if (is_string($this->view->showValue)) {
      $method = $this->view->showValue;
      $result = new ReflectionClass(get_class($record));
      if (!$result->hasMethod($method)) throw new Exception("متد " . $method . " در کلاس  " . $result . " وجود ندارد ");
      $method = $result->getMethod($method);
      try {
        return $method->invoke($record);
      } catch (Exception $e) {
      }
    }
    return null;
  }

  public function prepare($key, $value): XTd
  {
    $this->view->label = $key;
    $this->view->showValue = $value;
    $this->view->canViewInForm = false;
    $this->view->showInAdmin = [$value];
    $this->role->nullable = true;
    $this->view->method = $value;
    return $this;
  }
}
