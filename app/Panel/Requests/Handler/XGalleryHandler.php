<?php


namespace App\Panel\Requests\Handler;

use App\Panel\Dynamic\FieldsManager;
use App\Panel\helpers\ImageHelper;
use App\Panel\UiHandler\Elements\Element;

class XGalleryHandler
{
  public static function init(): array
  {
//    $model = getXRequest("model");
//    $model = str_replace(".", "\\", $model);
//    $field = getXRequest("field");
//    $file = getFileRequest('file');
//
//    $field = FieldsManager::getField($model, $field);
//    if ($field instanceof Element) {
//      $imageSizes = $field->preSave->imageSizes;
//      $uploadPath = $field->preSave->uploadPath;
//    } else {
//      $imageSizes = [1200];
//      $uploadPath = "dropzone/gallery/images";
//    }

//    $result = ImageHelper::upload($file, $uploadPath, $imageSizes);
//
//    return [
//      'path' => $result,
//      'isArray' => count($imageSizes) > 1,
//      'index' => getXFirstIndex($imageSizes)
//    ];
  }
}
