<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Models\Attachment;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $link
 * @property $position
 * @property $images
 * @property $approved
 * @property $created_at
 * @property $updated_at
 */
class Slide extends LiModel
{
  protected ?string $title = "اسلاید";

  public static ?string $sortField = "position";

  public function fields(): array
  {
    return [
      xField()->string("link")->showInTable()->linkMode()->label("لینک"),
      xField()->mediaChooser("images")->showInTable()->label("تصویر اسلاید"),
      xField()->bool("approved")->label("فعال")->tdLabel("وضعیت")->showInTable()->switchable(),
    ];
  }


  public function getImage($extension, $size): string|null
  {
    $attachment = Attachment::find($this->images);
    if ($attachment) {
      return $attachment->getLink($extension, $size);
    }
    return null;
  }

  public function getWebPsPaths()
  {
    $result = "";
    $imageWebP = $this->getImage("webp", 800);
    $imageWebP2 = $this->getImage("webp", 1920);
    $result .= $imageWebP . " 800w,";
    $result .= $imageWebP2 . " 1920w";
    return $result;
  }

  public function getDefaultImage(): string
  {
    return $this->getImage("jpg", 800);
  }

  public function getJpegsPaths()
  {
    $result = "";
    $imageWebP = $this->getImage("jpg", 800);
    $imageWebP2 = $this->getImage("jpg", 1920);
    $result .= $imageWebP . " 800w,";
    $result .= $imageWebP2 . " 1920w";
    return $result;
  }

}
