<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;

class LanguageData extends LiModel
{
  protected $table = "packages";
  protected bool $isTableOff = true;
  public static ?string $indexView = "languages.index";
  protected ?string $title = 'اطلاعات زبان';
  public bool $menuOff = true;


}
