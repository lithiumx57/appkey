<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\Exceptions\XPanelException;
use App\Panel\helpers\XStringHelper;
use App\Panel\UiHandler\Elements\Attributes\RelationAttributes;
use App\Panel\UiHandler\Elements\Attributes\SelectableAttributes;

class XForeign extends Element
{
  use RelationAttributes, SelectableAttributes;

  protected string $viewPath = "foreign";


  public function init(): void
  {
    $this->view->smartSelect = true;
  }

  /**
   * @throws XPanelException
   */
  public function getForeignRows()
  {
    if ($this->query->model == null) {
      throw new XPanelException("مدل برای فیلد " . $this->view->label . " تعیین نشده است");
    }

    if ($this->view->bigData) {
      return [];
//      return $this->query->model::where($this->query->conditions)->limit(5);
    }else{
      return $this->query->model::where($this->query->conditions)->get();
    }
  }


  public function isParentableX(): bool
  {
    return $this->view->parentable != null;
  }

  public function initParent($object, $relation, $renderField): string
  {
    if ($object == null) return "";
    if (is_array($renderField)) {
      $result = $this->initParent($object->$relation, $relation, $renderField);
      $i = 0;
      foreach ($renderField as $row) {
        $i++;
        $result .= $object->$row . " ";
        if ($i < count($renderField)) {
          $result .= " - ";
        }
      }
      return "( $result ) <span style='color: #ff4444'> ~!~ </span>";
    } else {
      return $this->initParent($object->$relation, $relation, $renderField) . " -> " . "( $object->$renderField )";
    }

  }


  /**
   * @throws XPanelException
   */
  public function getViewer($model): ?string
  {
    $relation = $this->query->relation;

    throwErrorIfMethodNotExistsInClass($model, $relation);

    $relation = $model->$relation;


    $renderFields = $this->query->renderFields;

    $result = "";
    $i = 0;
    if (!($relation instanceof $this->query->model)) {
      foreach ($this->view->defaultSelectItems as $key => $value) {
        $name = $this->name;
        if ($key == $model->$name) {
          $result .= $value;
        }
      }
      return $result;
    }
    foreach ($renderFields as $renderField) {
      $i++;
      $result .= $relation->getAttribute($renderField);
      if (count($renderFields) > $i) {
        $result .= " - ";
      }
    }

    return $result;
  }





  //@if ($object->isEditMode())
  //    @if (old($name, $record->$name) == $m->$primaryKey) selected @endif
  //                @else
  //                @if (old($name, @$row->view->categories) == $m->$primaryKey) selected @endif
  //                @endif

  public function getSelectedText($m): string
  {
    $record = $this->record;
    $name = $this->name;
    $primaryKey = $this->query->primaryKey;
    if ($this->isEditMode()) {
      if (old($name, $record->$name) == $m->$primaryKey) return "selected";
    } else {
      if (old($name, $this->view->default) == $m->$primaryKey) return "selected";
    }
    return "";
  }


  public function getIfDefaultItemSelected($key): string
  {
    $name = $this->name;
    if (old($name) != null && $key == old($name)) {
      return "selected";
    } else if ($key == $this->record->$name) {
      return "selected";
    }
    return "";
  }

  public function parentable($relation)
  {
    $this->view->parentable = $relation;
    return $this;
  }

  public function getName(): string
  {
    return $this->view->multiple ? $this->name . "[]" : $this->name;
  }

  public function getResult($m)
  {
    if ($this->isParentableX()) {
      $result = $this->initParent($m, $this->view->parentable, $this->query->renderFields);
      $result = explode("~!~", $result);
      unset($result[count($result) - 1]);
      echo join("->", $result);
    } else {
      $i = 0;
      foreach ($this->query->renderFields as $renderFieldRow) {
        $i++;
        if (XStringHelper::hasString($renderFieldRow, "->")) {
          $rf = explode("->", $renderFieldRow);
          $relation = $rf[0];
          $relationField = $rf[1];
          echo $m->$relation->getAttribute($relationField);
        } else {
          echo $m->getAttribute($renderFieldRow);
        }
        if (count($this->query->renderFields) > $i) {
          echo " - ";
        }
      }
    }
  }


}

