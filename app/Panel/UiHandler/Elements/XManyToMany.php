<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\helpers\ModelHelper;
use App\Panel\UiHandler\Elements\Attributes\RelationAttributes;
use App\Panel\UiHandler\UiDataHandler\XManyToManyDataHandler;

class XManyToMany extends Element
{

  use RelationAttributes;

  protected string $viewPath = "many-to-many";
  private ?string $model = null;
  public ?array $relationConditions = null;

  private ?string $table = null;


  public function prepare($relationMethod, $className, $renderField)
  {
    $this->relation->manyToMany = true;
    $this->relation->targetRelationClass = $className;
    $this->view->smartSelect = true;
    $this->role->nullable = true;

    if (is_array($renderField)) {
      $this->view->renderField = $renderField;
    } else {
      $this->view->renderField = [$renderField];
    }

    $result = debug_backtrace();
    $result = str_replace(base_path(), "", $result[1]['file']);
    $result = str_replace("\app", "App", $result);
    $result = str_replace(".php", "", $result);
    $this->model = $result;


//    throwErrorIfMethodNotExistsInClass($result, $relationMethod);
    return $this;
  }


  public function table($table): XManyToMany
  {
    $this->table = $table;
    return $this;
  }

  public function relationCondition(array $relationConditions)
  {
    $this->relationConditions = $relationConditions;
    return $this;
  }


  public function getViewer($record)
  {
    $field = $this;
    $object = $this;
    $name = $this->name;
    $this->model = str_replace("/", "\\", $this->model);

    $route = buildRoute(ModelHelper::getResourseRoute($this->model));
    return view('default.controls.many-to-many', compact('record', 'field', 'name', 'route','object'));
  }


  public function builder(): XManyToManyDataHandler
  {
    return XManyToManyDataHandler::getInstance()->build($this);
  }


}
