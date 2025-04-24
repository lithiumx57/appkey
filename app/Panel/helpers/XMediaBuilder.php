<?php

namespace App\Panel\helpers;

use App\Panel\Models\Attachment;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;

class XMediaBuilder
{
  public static function init($attachmentOrAttachmentId, $size, $extension, $prefixPath, $name = null, $quality = 80):string|null
  {
    if (is_numeric($attachmentOrAttachmentId)) $attachment = Attachment::find($attachmentOrAttachmentId);
    else $attachment = $attachmentOrAttachmentId;
    $isCdnMode = getConfigurator()->getCdnDir();
    $cdnDir = getConfigurator()->getCdnDir();
    if (!$attachment){
      return "";
    }
    $path = $attachment->getLink(true);
    $path=strtolower($path);

    if (!file_exists($path)) return null;
    if (!$name) $name = pathinfo($path, PATHINFO_FILENAME);
    list($width, $height) = getimagesize($path);
    $h = (int)($height * $size / $width);
    $manager = ImageManager::gd()->read($path);
    $date = Carbon::parse($attachment->created_at)->format('Y/m');
    $prefix = $isCdnMode ? $cdnDir . "/files/cache/" . $prefixPath . "/" . $date : "/files/cache/" . $prefixPath . "/" . $date;
    $targetPath = $prefix . '/' . $size . "_" . $name . "." . $extension;

    XFileHelper::mkdirs(getConfigurator()->getCdnDir() ? $prefix : public_path($prefix));

    if ($extension == "jpg") $manager->toJpeg();
    else if ($extension == "webp") $manager->toWebp();
    else if ($extension == "png") $manager->toPng();

    $manager->resize($size, $h)->save($targetPath, quality: $quality);

    $path = "/" . "files/cache/"  . $prefixPath . "/" . $date . "/" . $size . "_" . $name . "." . $extension;
    return $isCdnMode ? getConfigurator()->getCdnWebsite() . $path : $path;

  }
}
