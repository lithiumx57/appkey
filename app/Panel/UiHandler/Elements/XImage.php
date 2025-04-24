<?php


namespace App\Panel\UiHandler\Elements;

use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\Image\XImageUploader;
use App\Panel\helpers\XFileHelper;
use App\Panel\UiHandler\Elements\Attributes\UploadAttributes;
use Exception;
use Illuminate\Http\UploadedFile;

class XImage extends Element
{

  use UploadAttributes;

  protected string $viewPath = "image";
  private ?string $domain = null;
  private ?string $prefix = null;

  private bool $loadFromDomain = false;

  public function loadFromDomain():XImage
  {
    $this->loadFromDomain = true;
    return $this;
  }

  public function init(): void
  {
    $this->role->patchNotRequired = true;
  }


  /**
   * @param $sizes
   * سایز می تواند آرایه یا varargs باشد تصویر شما در این سایز ها آپلود خواهد شد
   * @return $this
   */
  public function sizes(...$sizes): XImage
  {
    if (isset($sizes[0]) && is_array($sizes[0])) {
      $sizes = $sizes[0];
    }

    $this->preSave->imageSizes = $sizes;
    return $this;
  }


  /**
   * @param array{"webp", "jpg", "png","gif"} $fruits
   */
  public function extensions(...$extensions): XImage
  {
    $this->preSave->extensions = $extensions;
    return $this;
  }


  public function prefixPath($prefix): XImage
  {
    $this->prefix = $prefix;
    return $this;
  }

  public function getViewer($record): ?string
  {
    $this->record = $record;
    $image = $this->getPath();

    $imageLarge = $image;
    if (is_array($image)) {
      $imageLarge = @$image[getLatestArrayKey($image)];
      $image = @$image[getXFirstIndexKey($image)];
    }


    return "<img data-large-image='" . $imageLarge . "' class='show-popup-image' src='" . $image . "' alt='' style='width: 60px;border-radius:6px;box-shadow:0 0 7px 0 #333;cursor:pointer'>";
  }

  public function getSizes(): array|null
  {
    return $this->preSave->imageSizes;
  }


  public function createOrUpdate(LiModel $object): array|string|null
  {
    $fillAble = $this->name;
    $image = request()->file($fillAble);

    $savePath = $this->getSaveDirectory();
    $reserveSizes = $this->getSizes();
    $extensions = $this->preSave->extensions;


    if (isPatchMethod() && $object->$fillAble != null && $image != null) {
      $result = $object->$fillAble;
      XFileHelper::deleteFile($result, $savePath);
    }


    if ($image instanceof UploadedFile) {
      return XImageUploader::getInstance()->setFile($image)->setExtensions($extensions)->setSavePath($savePath)->setSizes($reserveSizes)->upload();
    }

    return $object->$fillAble;
  }


  public function getPath(): string|array
  {
    $fillable = $this->name;
    $result = $this->record->$fillable;

    try {
      $result=getXFirstIndex($result);
    }catch (Exception $exception){

    }


    if (getConfigurator()->isAbsolutePath()) return $this->bindDomainName($result);
    if (!is_array($result)) $result = [$result];


    $records = [];
    $dir = $this->getSaveDirectory();
    if ($this->prefix != null) {
      $dir = $this->prefix;
    }
    foreach ($result as $key => $value) {
      $records[$key] = $this->bindDomainName("/" . $dir . "/" . $value);
    }
    return $records;
  }

  public function domain($domain): XImage
  {
    $this->domain = $domain;
    return $this;
  }

  private function bindDomainName($image): string
  {

    if ($this->loadFromDomain) {
      $domain = $this->domain === null ? getConfigurator()->getDomainName() : $this->domain;
    } else {
      $domain = "";
    }

    return $domain . $image;
  }


}
