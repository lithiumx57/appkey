<?php

namespace App\Panel\helpers\Image;

use App\Panel\helpers\ImageHelper;
use App\Panel\helpers\XFileHelper;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Mockery\Exception;
use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Intervention\Image\ImageManager;

class XImageUploader
{

  private ?string $savePath = null;
  private ?array $sizes = null;
  private ?string $name = null;
  private ?array $extensions = null;
  private ?bool $saveMainImage = null;
  private ?bool $generateThumbnail = null;
  private ?bool $isWebP = false;
  private ?UploadedFile $file = null;

  public static function getInstance(): XImageUploader
  {
    return new XImageUploader();
  }

  public function setSavePath(string $path): XImageUploader
  {
    $this->savePath = $path;
    return $this;
  }

  public function setSizes(...$sizes): XImageUploader
  {
    if (is_array(@$sizes[0])) {
      $this->sizes = $sizes[0];
    } else {
      $this->sizes = $sizes;
    }
    return $this;
  }


  public function setName(string $name): XImageUploader
  {
    $this->name = $name;
    return $this;
  }

  public function saveMainImage(): XImageUploader
  {
    $this->saveMainImage = true;
    return $this;
  }

  public function generateThumbnail(): XImageUploader
  {
    $this->generateThumbnail = true;
    return $this;
  }

  public function webP()
  {
    $this->isWebP = true;
    return $this;
  }

  public function setFile(UploadedFile $uploadedFile): XImageUploader
  {
    $this->file = $uploadedFile;
    return $this;
  }

  public function setExtensions($extensions): XImageUploader
  {
    $this->extensions = $extensions;
    return $this;
  }

  private function getName(): string
  {
    $name = $this->name;
    if ($name == null) $name = time() . "" . rand(1, 9999999);
    else $name = Str::slug($name);
    if ($this->isWebP) {
      return $name . ".webp";
    } else {
      return $name . "." . strtolower($this->file->getClientOriginalExtension());
    }
  }

  private function getSavePath(): string
  {
    return $this->savePath;
  }


  public function upload(): array|string
  {
    $name = $this->getName();
    $path = $this->getSavePath();
    $file = $this->file;
    $uploadedFile = $file->move($path, $name);

    list($width, $height) = getimagesize($uploadedFile->getRealPath());

    $urls = [];

    if (is_array($this->sizes)) {
      $imageManager = new ImageManager(new Driver());
      $image = $imageManager->read($uploadedFile->getRealPath());

      foreach ($this->sizes as $size) {
        $h = intval(($height * $size) / $width);
        $resizedImage = clone $image;
        $resizedImage->resize($size, $h);

        foreach ($this->extensions ?? ['jpg', 'png', 'webp'] as $format) {
          $filename = "{$size}_" . pathinfo($name, PATHINFO_FILENAME) . ".{$format}";
          $savePath = "{$path}/{$filename}";
          $resizedImage->save($savePath, 90, $format);
          $urls["{$size}_{$format}"] = $this->generateImagePath($filename);
        }
      }
    }

    if ($this->generateThumbnail) {
      $urls['thumbnail'] = $this->generateImagePath($name, $this->sizes[0]);
    }

    if (!$this->saveMainImage) {
      unlink($uploadedFile->getRealPath());
    } else {
      $urls["main"] = $this->generateImagePath($uploadedFile->getBasename());
    }

    return count($urls) ? $urls : $this->generateImagePath($uploadedFile->getBasename());
  }



  public function isBase64Image($base64String):bool
  {
    if (str_contains($base64String, ',')) {
      $base64String = explode(',', $base64String)[1];
    }
    $binaryData = base64_decode($base64String);

    $imageInfo = getimagesizefromstring($binaryData);
    if ($imageInfo !== false) return true;
    return false;
  }

  /**
   * @throws Exception
   */
  public function uploadFromBase64($dirPath, $base64Image, $sizes): array
  {
    if (!$this->isBase64Image($base64Image)) {
      throw new Exception("فایل آپلود شده تصویر نمی باشد");
    }

    $filePath = XFileHelper::uploadBase64($dirPath, $base64Image);
    $path = public_path($filePath);


    file_put_contents($path, ImageHelper::base64Decode($base64Image));
    list($width, $height) = getimagesize($path);

    $size = getimagesize($path);
    $mime = str_replace("image/", "", $size["mime"]);
    $uploadedFile = new UploadedFile($path, Str::uuid() . "." . $mime);
    $urls = [];
    if (is_array($sizes)) {
      foreach ($sizes as $size) {
        $urls[$size] = $this->generateImagePath($uploadedFile->getBasename(), $size);
        $manager = ImageManager::gd()->read($uploadedFile->getRealPath());
        $h = $height * $size / $width;
        $manager->resize($size, $h)->save($uploadedFile->getPath() . '/' . $size . "_" . $uploadedFile->getBasename());
      }
    }
    unlink($path);
    return $urls;
  }


  private function generateImagePath($uploaded, $size = null): string
  {
    $prefix = "";
    if ($size != null) $prefix = $size . "_";
    if (getConfigurator()->isAbsolutePath()) return "/" . $this->getSavePath() . "/" . $prefix . $uploaded;
    return $prefix . $uploaded;
  }


}
