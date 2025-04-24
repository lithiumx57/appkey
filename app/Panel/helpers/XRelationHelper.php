<?php


namespace App\Panel\helpers;

use App\Panel\Dynamic\FieldsManager;
use App\Panel\Dynamic\LiModel;
use App\Panel\Models\Tag;
use App\Panel\Models\TagModel;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\Elements\XManyToMany;
use App\Panel\UiHandler\Elements\XPermission;
use App\Panel\UiHandler\Elements\XTag;
use App\Panel\UiHandler\XFieldHelper;
use Exception;
use ReflectionClass;

class XRelationHelper
{
  public static function getManyToManyTableName($class1, $class2): string
  {
    $model1 = strtolower(ModelHelper::getName($class1));
    $model2 = strtolower(ModelHelper::getName($class2));
    if ($model1[0] < $model2[0]) {
      return $model1 . "_" . $model2;
    }
    return $model2 . "_" . $model1;
  }


  public static function initManyToMany(Element $element, LiModel $object): void
  {
    if (!($element instanceof XManyToMany)) return;


    $object->xObjectSyncing(function () use ($element, $object) {
      $name = $element->name;
      $records = request()->post($name);
      if ($records == null) $records = [];

      try {
        $clazz = new ReflectionClass($object);
        if ($clazz->hasMethod($name)) {
          $object->$name()->sync($records);
        }
      } catch (Exception $e) {
        dd($e->getMessage());
      }

    });
  }

  public static function initRelations(LiModel $object): void
  {
    $elements = XFieldHelper::getMergedFields(get_class($object));
    foreach ($elements as $element) {
      self::initManyToMany($element, $object);
    }
  }


  public static function syncPermission(LiModel $object): void
  {
    $elements = XFieldHelper::getMergedFields(get_class($object));
    foreach ($elements as $element) {
      if ($element instanceof XPermission) {
        $object->permissions()->sync(getXRequest("permissions"));
      }
    }
  }

  public static function initTags($object): void
  {
    $fields = XFieldHelper::merge(FieldsManager::getFields());
    foreach ($fields as $element) {
      if ($element instanceof XTag) {

        if ($element->preSave->escapeTags) continue;


        TagModel::where("model_id", $object->id)
          ->where("tag_name", $element->name)
          ->where("model", get_class($object)
          )->delete();


        $value = getXRequest($element->name);
        $records = explode("||", $value);
        $records = str_replace("|", "", $records);


        foreach ($records as $record) {
          if (!is_string($record)) continue;
          $tag = Tag::where("tag", $record)->first();
          if (!($tag instanceof Tag)) {
            $tag = Tag::create([
              "tag" => $record,
              "use_count" => 0,
              "click_count" => 0,
            ]);
          }
          self::addModelTohashtag($tag, $object, $element->name);

        }


      }
    }
  }


  private static function addModelTohashtag(Tag $tag, $object, $tagName): void
  {
    $data = ["tag_id" => $tag->id, "tag_name" => $tagName, "model" => get_class($object), "model_id" => $object->id];
    $tagModel = TagModel::where($data)->first();
    if (!($tagModel instanceof TagModel)) TagModel::create($data);
  }

}
