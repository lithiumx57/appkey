<?php

namespace App\Panel\UiHandler\Elements;

use App\Panel\Models\Attachment;
use App\Panel\UiHandler\Elements\Attributes\UploadAttributes;

class XMediaChooser extends Element
{
  use UploadAttributes;

  protected string $viewPath = "media-chooser";

  public function getLink(): string
  {
    $name = $this->name;
    if (!$this->record) return "";
    $id = $this->record->$name;
    if (!$id) return "";
    $attachment = Attachment::find($id);
    if (!$attachment) return "";
    return $attachment->getLink();
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

    if (self::isVideo($attachment->getLink())) {
      return "<video controls='on' src='" . $attachment->getLink() . "' width='80' style='border-radius: 8px'/>";
    } else if (self::isImage($attachment->getLink())) {
      return "<img src='" . $attachment->getLink() . "' width='80' style='border-radius: 8px'/>";
    }
    return "-";
  }

  public static function isVideo($link): bool
  {
    if (empty($link)) {
      return false;
    }
    $videoExtensions = ['mp4', 'avi', 'mkv', 'mov', 'flv', 'wmv', 'webm'];
    $pathInfo = pathinfo(parse_url($link, PHP_URL_PATH));

    if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $videoExtensions)) {
      return true;
    }
    $videoDomains = ['youtube.com', 'youtu.be', 'vimeo.com', 'dailymotion.com', 'aparat.com'];

    $host = parse_url($link, PHP_URL_HOST);
    foreach ($videoDomains as $domain) {
      if (str_contains($host, $domain)) return true;
    }

    return false;
  }

  public static function isImage($link): bool
  {

    // بررسی اگر لینک خالی باشد
    if (empty($link)) {
      return false;
    }

    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'tiff', 'svg'];
    $pathInfo = pathinfo(parse_url($link, PHP_URL_PATH));

    if (isset($pathInfo['extension']) && in_array(strtolower($pathInfo['extension']), $imageExtensions)) {
      return true;
    }

    $headers = @get_headers($link, 1);
    if ($headers && isset($headers['Content-Type'])) {
      $contentType = is_array($headers['Content-Type']) ? $headers['Content-Type'][0] : $headers['Content-Type'];
      if (strpos($contentType, 'image/') === 0) {
        return true;
      }
    }

    return false;
  }

  public function getAttachmentId(): int|null
  {
    if (!$this->isEditMode()) {
      return null;
    }

    $fble = $this->name;

    return $this->record->$fble;

  }


}
