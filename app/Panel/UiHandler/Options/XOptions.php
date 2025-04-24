<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XConditionsHelper;
use App\Panel\Singleton\XModelSingleton;

class XOptions
{
  use TrashHelper, CreateHelper, EditHelper, Restorehelper,
    DeleteHelper, IndexHelper, CustomHelper;

  private ?string $model = null;
  private static ?XOptions $xOptions = null;

  private array $options = [];
  private array $initializedOptions = [];


  public const DEFAULT_OPTION_CREATE = "DEFAULT_OPTION_CREATE";
  public const DEFAULT_OPTION_EDIT = "DEFAULT_OPTION_EDIT";
  public const DEFAULT_OPTION_DELETE = "DEFAULT_OPTION_DELETE";
  public const DEFAULT_OPTION_RESTORE = "DEFAULT_OPTION_RESTORE";
  public const DEFAULT_OPTION_INDEX = "DEFAULT_OPTION_INDEX";
  public const DEFAULT_OPTION_TRASH = "DEFAULT_OPTION_TRASH";
  public const DEFAULT_OPTION_OFF = "DEFAULT_OPTION_OFF";
  public const CUSTOM = "CUSTOM";

  public static function with(string $model): XOptions
  {
    if (self::$xOptions == null) self::$xOptions = new XOptions();
    self::$xOptions->model = $model;
    self::$xOptions->options = XModelSingleton::getModel($model)->options();
    return self::$xOptions;
  }


  public function initDebugMode()
  {
    if (getConfigurator()->isDebugMode()) {
      return [
        true, "dash-persmission-disabled"
      ];
    }
    return [
      false, ""
    ];

  }

  public static function render($model)
  {
    $options = static::with($model)->get();

    if (!self::$xOptions->hasOption(self::DEFAULT_OPTION_OFF)) {
      return "";
    }

    return view('options.index', compact('options'));
  }


  public function hasOption($type): bool
  {
    foreach ($this->options as $option) {
      if ($option->type == $type && !$option->enable) {
        return false;
      }
    }
    return true;
  }


  public function get(): array
  {
    if (ModelHelper::isIndexRoute($this->model) && isGetMethod()) {
      $this->buildCreateOption();
      $this->buildTrashOption();
      $this->buildEditOption();
      $this->buildDeleteOption();
      $this->buildCustomOption();
    } else if (isCreateMode() || isEditMode()) {
      $this->buildIndexOption();
      $this->buildTrashOption();
      $this->buildCustomOption();
    } else if (isTrashMode()) {
      $this->buildCreateOption();
      $this->buildIndexOption();
      $this->buildEditOption();
      $this->buildRestoreOption();
      $this->buildCustomOption();
    }

    return $this->initializedOptions;
  }


  public function getConditions(): string
  {
    $records = getXRequest("x-conditions");
    if (!($records && is_array($records) && count($records) > 0)) return "";
    return XConditionsHelper::create($records);
  }

}
