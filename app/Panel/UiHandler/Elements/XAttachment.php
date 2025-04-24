<?php

namespace App\Panel\UiHandler\Elements;

use App\Models\FullElement;
use App\Panel\Models\Attachment;
use App\Panel\UiHandler\Elements\Attributes\UploadAttributes;

class XAttachment extends Element
{
  use UploadAttributes;

  protected string $viewPath = "attachment";

  public function __construct()
  {
    parent::__construct();

    $this->preSave->extensions = [
      "webp", "jpg", "png"
    ];

    $this->preSave->imageSizes = [
      400, 700, 1200
    ];

  }

  /**
   * @param array{"webp", "jpg", "png","gif"} $fruits
   */
  public function extensions(...$extensions): XAttachment
  {
    $this->preSave->extensions = $extensions;
    return $this;
  }

  public function sizes(...$sizes): XAttachment
  {
    $this->preSave->imageSizes = $sizes;
    return $this;
  }

  public function getViewer($record)
  {
    $name = $this->name;
    $result = $record->$name;
    if (!is_numeric($result)) {
      return "-";
    }
    $attachment = Attachment::find($result);
    if (!$attachment) {
      return "-";
    }

    if (!getConfigurator()->getCdnDir()) {
      if (!file_exists(public_path($attachment->getLink()))) {
        return "-";
      }
    }


    return "<img src='" . $attachment->getLink() . "' width='80' style='border-radius: 8px'/>";
  }


}
