<?php

namespace App\Panel\UiHandler;

class XPreSave
{
  public ?array $imageSizes = null;
  public ?array $extensions = null;
  public $tokenFrom = null;
  public ?string $uploadPath = null;
  public ?string $cdnPath = null;
  public ?string $uploadName = null;
  public ?bool $escapeTags = false;
}
