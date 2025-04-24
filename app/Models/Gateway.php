<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Models\Attachment;
use Error;
use Exception;
use Throwable;

/**
 * @property $id
 * @property $name
 * @property $title
 * @property $approved
 * @property $tax
 * @property $image
 */
class Gateway extends LiModel
{
  const STATUS_PENDING = "pending";
  const STATUS_PAID = "paid";
  const STATUS_CANCELED = "canceled";


  protected ?string $title = "درگاه";
  public const ZARINPAL = 1;

  public const TRANSLATES = [
    self::ZARINPAL => "زرینپال",
  ];

  protected array $slugFields = [
    "slug" => "name"
  ];

  public static ?string $sortField = "position";


  public static function translate($gatewayId): string
  {
    return self::TRANSLATES[$gatewayId];
  }

  public function fields(): array
  {
    return [
      xField()->string("name")->label("نام")->showInTable(),
      xField()->string("title")->label("عنوان")->showInTable(),
      xField()->bool("approved")->switchable()->label("فعال")->tdLabel("وضعیت")->showInTable(),
      xField()->number("tax")->depend(0)->label("مالیات")->showInTable(),
      xField()->mediaChooser("image")->uploadPath("gateways")->label("لوگو درگاه")->showInTable(),
    ];
  }


  public function getLogo(): string|null
  {
    try {
      return Attachment::find($this->image)->getLink("");
    } catch (Exception|Error|Throwable) {
      return null;
    }
  }


}
