<?php

namespace App\Panel\Actions;

use App\Panel\Controllers\AdminController;

class XActionPopup extends XAction
{
  private string $content = "";
  private bool $isMethod = false;
  public bool $isButtonMode = false;
  private string $textAlign = "justify";
  private string $direction = "rtl";

  private string $method = "";

  private int $minWidth = 300;
  private int $minHeight = 200;
  private int $maxWidth = 1288;
  private int $maxHeight = 768;

  private string $backgroundColor = "#eeeeee";
  private string $headerBackgroundColor = "#0c9ea2";
  private string $headertextColor = "#ffffff";
  private string $textColor = "#222222";
  private ?string $headerTitle = "فعلا تست";
  private int $paddingTop = 8;
  private int $paddingBottom = 8;
  private int $paddingLeft = 8;
  private int $paddingRight = 8;
  private array $closeByClickOn = [];

  private int $width = 800;
  private int $height = 600;


  public function setHeaderBackgroundColor(string $color):XActionPopup
  {
    $this->headerBackgroundColor = $color;
    return $this;
  }


  public function setPaddingTop($padding):XActionPopup
  {
    $this->paddingTop = $padding;
    return $this;
  }

  public function setPaddingBottom($padding):XActionPopup
  {
    $this->paddingBottom = $padding;
    return $this;
  }

  public function setPaddingRight($padding):XActionPopup
  {
    $this->paddingRight = $padding;
    return $this;
  }

  public function setPaddingLeft($padding):XActionPopup
  {
    $this->paddingLeft = $padding;
    return $this;
  }

  public function setHorizontalPadding($padding):XActionPopup
  {
    $this->paddingLeft = $padding;
    $this->paddingRight = $padding;
    return $this;
  }

  public function setVerticalPadding($padding):XActionPopup
  {
    $this->paddingTop = $padding;
    $this->paddingBottom = $padding;
    return $this;
  }


  public function setPadding(int $padding): XActionPopup
  {
    $this->paddingTop = $padding;
    $this->paddingBottom = $padding;
    $this->paddingLeft = $padding;
    $this->paddingRight = $padding;
    return $this;
  }


  public function setHeaderTextColor(string $color):XActionPopup
  {
    $this->headertextColor = $color;
    return $this;
  }


  public function setDirection(string $direction):XActionPopup
  {
    $this->direction = $direction;
    return $this;
  }


  public function closeByClickOn($tags):XActionPopup
  {
    $this->closeByClickOn = $tags;
    return $this;
  }


  public function init(bool $isMethod = false, string $content = ""):XActionPopup
  {
    $this->isMethod = $isMethod;
    $this->content = $content;
    return $this;
  }

  public function methodMode(): XActionPopup
  {
    $this->isMethod = true;
    return $this;
  }


  /**
   * @param string $method
   * متد باید یه چیزی رو برگردونه اگه استاتیک بود رکورد به صورت خودکار به متد پاس داده میشه
   */

  public function setMethod(string $method): XActionPopup
  {
    $this->isMethod = true;
    $this->method = $method;
    return $this;
  }


  public function setContent($content): XActionPopup
  {
    $this->content = $content;
    return $this;
  }


  public function setBackgroundColor(string $backgroundColor): XActionPopup
  {
    $this->backgroundColor = $backgroundColor;
    return $this;
  }

  public function setTextColor(string $textColor): XActionPopup
  {
    $this->textColor = $textColor;
    return $this;
  }

  public function setHeaderTitle(?string $headerTitle): XActionPopup
  {
    $this->headerTitle = $headerTitle;
    return $this;
  }


  public function setMinWidth(int $minWidth): XActionPopup
  {
    $this->minWidth = $minWidth;
    return $this;
  }

  public function setMinHeight(int $minHeight): XActionPopup
  {
    $this->minHeight = $minHeight;
    return $this;
  }

  public function setMaxWidth(int $maxWidth): XActionPopup
  {
    $this->maxWidth = $maxWidth;
    return $this;
  }

  public function setMaxHeight(int $maxHeight): XActionPopup
  {
    $this->maxHeight = $maxHeight;
    return $this;
  }

  public function setWidth(int $width): XActionPopup
  {
    $this->width = $width;
    return $this;
  }

  public function setHeight(int $height): XActionPopup
  {
    $this->height = $height;
    return $this;
  }

  public function setTextAlign(string $align): XActionPopup
  {
    $this->textAlign = $align;
    return $this;
  }


  public function build():void
  {
    $this->attributes = [
      "is-method" => $this->isMethod,
      "content" => $this->content,
      "direction" => $this->direction,
      "background-color" => $this->backgroundColor,
      "text-color" => $this->textColor,
      "header-title" => $this->headerTitle,
      "min-width" => $this->minWidth,
      "method" => $this->method,
      "min-height" => $this->minHeight,
      "top-padding" => $this->paddingTop,
      "right-padding" => $this->paddingRight,
      "bottom-padding" => $this->paddingBottom,
      "left-padding" => $this->paddingLeft,
      "text-align" => $this->textAlign,
      "close-by-click-on" => join(",", $this->closeByClickOn),
      "header-background-color" => $this->headerBackgroundColor,
      "header-text-color" => $this->headertextColor,
      "max-width" => $this->maxWidth,
      "max-height" => $this->maxHeight,
      "width" => $this->width,
      "model" => str_replace("\\", "/", AdminController::$model),
      "height" => $this->height,
      "type" => "DEFAULT_ACTION_POPUP",
    ];
  }


}
