<?php

namespace App\Panel\UiHandler\Elements\Attributes;

trait PublicAttributes
{
  public function showInTable()
  {
    $this->view->showInAdmin = true;
    return $this;
  }

  public function tdValue($value)
  {
    if ($value == null) $value = "وارد نشده";
    $this->view->showValue = $value;
    return $this;
  }



  /**
   * @param $label
   * عنوان فیلد
   * @return PublicAttributes
   */

  public function label($label)
  {
    $this->view->label = $label;
    return $this;
  }

  public function customName($name)
  {
    $this->view->customName = $name;
    return $this;
  }


  /**
   * @param $array
   * آرایه ای که داخلش جست و جو کنه و آی دی رو پیدا کرد selected کنه
   * @return PublicAttributes
   */

  public function checkFromArray($array)
  {
    $this->view->checkFromArray = $array;
    return $this;
  }

  public function placeholder($placeholder)
  {
    $this->view->placeholder = $placeholder;
    return $this;
  }

  public function method($method)
  {
    $this->view->method = $method;
    return $this;
  }

  public function preEdit($method)
  {
    $this->view->preFormMethod = $method;
    return $this;
  }


  public function styles($styles)
  {
    $this->view->styles = $styles;
    return $this;
  }


  public function parentStyles($styles)
  {
    $this->view->parentStyle = $styles;
    return $this;
  }


  public function classes($classes)
  {
    $this->view->classes = $classes;
    return $this;
  }


  public function parentClasses($classes)
  {
    $this->view->parentClasses = $classes;
    return $this;
  }


  /**
   * @param $defaultValue
   * مقدار پیشفرض فیلد
   * @return $this
   */
  public function default($defaultValue)
  {
    $this->view->default = $defaultValue;
    return $this;
  }


  public function hint($hint)
  {
    $this->view->hint = $hint;
    return $this;
  }


  public function depend($depend, $value = true)
  {
    if (!is_array($depend)) {
      if ($value != null) $depend = [$depend => $value];
    }
    $this->view->depend = $depend;
    return $this;
  }

  function nullable()
  {
    $this->role->nullable = true;
    return $this;
  }


  function tdLabel($label)
  {
    $this->view->tdLabel = $label;
    return $this;
  }

  function ltr()
  {
    $this->view->ltr = true;
    return $this;
  }


  function rtl()
  {
    $this->view->ltr = false;
    return $this;
  }


}
