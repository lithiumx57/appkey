<?php


namespace App\Panel\UiHandler\Elements;

use App\Panel\Controllers\AdminController;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XConditionsHelper;
use App\Panel\helpers\XStringHelper;
use App\Panel\Models\Language;
use App\Panel\UiHandler\Elements\Attributes\FiltersAttributes;
use App\Panel\UiHandler\Elements\Attributes\PublicAttributes;
use App\Panel\UiHandler\Elements\Builder\ElementBuilder;
use App\Panel\UiHandler\XFieldHelper;
use App\Panel\UiHandler\XPreSave;
use App\Panel\UiHandler\XQuery;
use App\Panel\UiHandler\XRelation;
use App\Panel\UiHandler\XRole;

abstract class Element
{
  use  PublicAttributes, FiltersAttributes;

  public ?XView $view = null;
  public ?XQuery $query = null;
  public ?XRole $role = null;
  public ?XPreSave $preSave = null;
  public ?XRelation $relation = null;
  public ?LiModel $record = null;

  private ?string $dependData = null;

  protected string $viewPath = "string";

  public string $name = "null";




  public function __construct()
  {
    $this->initialize();
  }

  public function get(string $name)
  {
    $this->name = $name;
    $this->init();
    return $this;
  }

  protected function setDefaults()
  {
    $result = @VALIDATION[$this->name];
    if ($result) $this->view->label = $result;
    else $this->view->label = $this->name;
  }


  private function initialize()
  {
    $this->view = new XView();
    $this->query = new XQuery();
    $this->role = new XRole();
    $this->preSave = new XPreSave();
    $this->relation = new XRelation();
  }


  public function init(): void
  {
  }


  private function initDefaults()
  {
    $this->view->label = XFieldHelper::getLabel($this);
  }

  private function initLabel()
  {
    $this->initialize();
    if (isset(VALIDATION[$this->name])) {
      $this->view->label = VALIDATION[$this->name];
    }
  }


  protected function addAttribute($type, $key, $value)
  {
    $key = str_replace($type, "", $key);
    $key = lcfirst($key);
    $type = $this->$type;
    $type->$key = $value;
  }


  public function render($record = null, $isOnlyRender = false)
  {
    $this->initDefaults();
    $this->initDepend();

    $preFormMethod=$this->view->preFormMethod;
    if ($preFormMethod){
      if ($this->isEditMode()){
        $record->$preFormMethod();
      }
    }


    $this->record = $record;
    if ($isOnlyRender) AdminController::$model = new Language();
    if (!($record instanceof AdminController::$model)) $this->record = new AdminController::$model();

    $renderPath = $this->viewPath;
    $name = $this->name;
    $view = $this->view;
    $query = $this->query;
    $object = $this;
    $this->initCallPreFormMethod();
    $value = $this->getValue();


    if (XStringHelper::hasString($this->name, "[")) {
      $indexName = explode("[", $this->name)[0];
//      $result = $record->$indexName;
      $index = str_replace($indexName . "[", "", $this->name);
      $index = str_replace("]", "", $index);
      $value = @$record->$indexName[$index];
    }


    if ($this->view->viewData != null)
      return $this->view->viewData;
    if (!$this->view->canViewInForm)
      return "";


    $additionalData = $this->dependData;
    $additionalData .= " style='" . $this->view->parentStyle . "'";


    if ($this->view->hint != null) {
      $hint = $this->view->hint;
      $additionalData .= " title='" . $hint . "'  data-toggle='tooltip' data-placement='left'";
    }


    if (XConditionsHelper::has($this->name)) {
      return "<input type='hidden' name='" . $this->name . "' value='" . XConditionsHelper::get($this->name) . "' />";
    }

    $model = get_class($object->record);
    return view('controls.' . $renderPath, compact('name', 'view', 'query', 'object', 'record', 'value', 'additionalData', 'model'));
  }



  private function initDepend()
  {
    $depend = $this->view->depend;
    $depend = json_encode($depend);
    if ($depend != "null") {
      $this->dependData = "";
      $this->dependData .= " data-has-depend='true' data-name=$this->name " . " data-depend-data=$depend ";
    }
  }

  private function initCallPreFormMethod()
  {
    $form = $this->view->form;
    if ($form != null) {
      $this->record->$form();
    }
  }

  public function getValue()
  {
    if ($this->isEditMode()) {
      $name = $this->name;
      $record = $this->record;
      $result = old($name, $record->getAttribute($name));
      if ($result == null)
        $result = $this->view->default;
      return $result;
    }
    return old($this->name, $this->view->default);
  }


  public function isEditMode(): bool
  {
    return AdminController::$isEditMode;
  }


  public final function getShowData($record)
  {
    $name = $this->name;
    $dialogMode = $this->view->dialogMode;
    if (is_array($dialogMode)) return $this->getDialogMode($record, $name);
    return $this->getViewer($record);
  }


  public function getViewer($record)
  {
    $this->initLink($record);
    $this->initCallMethod($record);
    $name = $this->name;
    return $record->getAttribute($name);
  }


  protected function initCallMethod($record)
  {
    $method = $this->view->method;
    if ($method != null)
      $record->$method();
  }

  protected function initLink($record)
  {
    $name = $this->name;
    if ($this->view->linkMode) {
      $record->$name = "<a style='color=#fff;border-bottom:1px dashed #fff' target='_blank' href='" . $this->view->linkPrefix . $record->$name . "'>" . $record->$name . "</a>";
    }
  }

  public static function createInstance()
  {
    return new ElementBuilder();
  }


}
