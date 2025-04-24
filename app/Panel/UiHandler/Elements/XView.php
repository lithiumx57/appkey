<?php


namespace App\Panel\UiHandler\Elements;


class XView
{
  public string $lat;
  public ?string $tdLabel = null;

  public array $dynamicName = array();

  public string $lng;
  public string $fileManagerPath;

  public string $selectable;

  public ?string $viewData = null;
  public ?string $mapRenderText = null;

  public $type;
  public $center = false;
  public $dynamicPlaceholders = [];
  public $hint;
  public $showInAdmin = false;
  public string $label = "";
  public $show = true;
  public $parentable = null;
  public ?string $form = null;

  public ?array $dialogMode = null;

  public $renderField;
  public $classes = "";
  public $method = null;
  public $preFormMethod = null;
  public $linkMode = null;
  public $customName = null;
  public $iconFilter = null;
  public $clearfixOff = false;

  public $parentClasses = "";
  public $placeholder = null;
  public $parentClass = "";
  public $responsive = "";
  public $selectItems;
  public $dynamicType = "text";
  public $dynamicTagName = "input";
  public $switchable;
  public $smartSelect = false;
  public $fillAble = "";
  public $multiple = false;
  public $smartEditor = false;
  public $hr = false;
  public $styles = "";
  public $depend = null;
  public $depender = false;

  public $hasDepend = false;
  public $dependTo = null;
  public $dependValue = null;
  public $selected = null;
  public $canView = null;
  public $canViewInForm = true;

  public $checkFromArray = null;

  public $default = null;
  public $ltr = false;
  public $parentStyle = "";
  public $arrayCountable = false;
  public $selectOptions = [];
  public $col = "";
  public $isCustomView = false;
  public $disabled = false;
  public $showValue = null;
  public $linkPrefix = "/";

  public $isMultipleTypes = false;
  public $mimes = [];
  public $uploaderTypeFields = [];
  public $customViewName = null;
  public $defaultSelectItems = [];
  public $indexOnly = false;
  public bool $bigData = false;
}
