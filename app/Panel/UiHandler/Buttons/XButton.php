<?php


namespace App\Panel\UiHandler\Buttons;


class XButton {

  public ?string $icon = null;
  public ?string $type = null;
  public ?string $id = null;
  public ?string $classes = null;
  public ?string $text = null;

  public const TYPE_SAVE = 1;
  public const TYPE_SAVE_AND_RETURN = 2;
  public const TYPE_CANCEL = 3;
  public const TYPE_CUSTOM = 4;


  public static function get(): XButton
  {
    return new XButton();
  }

  public function setIcon($icon): XButton
  {
    $this->icon = $icon;
    return $this;
  }

  public function setType($type): XButton
  {
    $this->type = $type;
    return $this;
  }


  public function setId($id): XButton
  {
    $this->id = $id;
    return $this;
  }

  public function setClass($classes): XButton
  {
    $this->classes = $classes;
    return $this;
  }

  public function setText($text): XButton
  {
    $this->text = $text;
    return $this;
  }


}
