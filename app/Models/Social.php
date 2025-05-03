<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;

/**
 * @property $id
 * @property $title
 * @property $link
 * @property $type
 * @property $approved
 * @property $svg
 * @property $position
 */
class Social extends LiModel
{
  protected ?string $pluralTitle = "راه های ارتباطی";
  protected ?string $title = "راه ارتباطی";
  public static ?string $sortField = "position";

  public const TYPE_INSTAGRAM = "instagram";
  public const TYPE_TELEGRAM = "telegram";
  public const TYPE_WHATSAPP = "whatsapp";
  public const TYPE_GITHUB = "github";
  public const TYPE_CODEPEN = "codepen";
  public const TYPE_EMAIL = "email";


  public const TYPES = [
    self::TYPE_INSTAGRAM => "اینستاگرام",
    self::TYPE_TELEGRAM => "تلگرام",
    self::TYPE_WHATSAPP => "واتس اپ",
    self::TYPE_GITHUB => "گیت هاب",
    self::TYPE_CODEPEN => "کد پن",
    self::TYPE_EMAIL => "ایمیل",
  ];

  public function fields(): array
  {
    return [
      xField()->select("type")->options(self::TYPES)->showInTable()->label("تایپ"),
      xField()->string("title")->label("عنوان")->showInTable()->center(),
      xField()->string("link")->linkMode()->label("لینک")->showInTable()->ltr(),
      xField()->bool("approved")->switchable()->label("فعال")->tdLabel("وضعیتس")->showInTable()->ltr(),
      xField()->text("svg")->label("svg")->showInTable()->ltr(),
    ];
  }


}
