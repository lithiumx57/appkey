<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\Models\Tag;
use App\Panel\Models\TagModel;
use App\Panel\UiHandler\Elements\Attributes\DialogAttribuites;

class XTag extends Element
{
  private string $model = "";
  use DialogAttribuites;

  public bool $stringMode = false;

  protected string $viewPath = "tag";

  public function init(): void
  {
    $result = debug_backtrace();
    $result = str_replace(base_path(), "", $result[2]['file']);
    $result = str_replace("\app", "App", $result);
    $result = str_replace(".php", "", $result);
    $this->model = $result;
    $this->view->dialogMode = [];
  }

  public function escapeTags(): XTag
  {
    $this->preSave->escapeTags = true;
    return $this;
  }

  public function getTags($record = null): string
  {
    if ($this->stringMode) {
      $attrs = "";

      if (isEditMode()) {
        $name = $this->name;
        $attributes = $record->getAttribute($name);
        if (is_array($attributes)) {
          $attrs = "|";
          $attrs .= implode("||", $attributes);
          $attrs .= "|";
        }
      }
      return  $attrs;
    }

    if (!($record instanceof $this->model) || !@$record->id) {
      return "";
    }

    $name = $this->name;
    $model = $this->model;
    $tags = TagModel::where("model", $model)->where("model_id", $record->id)->where("tag_name", $name)->pluck("tag_id")->toArray();
    $result = Tag::whereIn("id", $tags)->get()->pluck("tag")->toArray();
    return "|" . implode("||", $result) . "|";
  }

  public function buildByString(): XTag
  {
    $this->stringMode = true;
    return $this;
  }

  public function getViewer($record): ?string
  {
    $data = $this->getTags($record);

    if ($data == null) return "وارد نشده ";
    $tags = explode("|", $data);
    $result = "";

    $i = 0;
    foreach ($tags as $tag) {
      $i++;
      if ($tag == null) continue;
      $result .= "<a style='color: #0ab5d4;border-bottom: 1px dashed #0ab5d4'>" . $tag . "</a>";
      if (count($tags) > $i) $result .= " , ";
    }
    return $result;
  }
}
