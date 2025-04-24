<?php

namespace App\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Menu\XMenu;

class AData extends LiModel
{
  protected ?string $title = "داده";
  protected bool $isTableOff = true;

  public function menu(): ?XMenu
  {


    //xSubmenu("مقادیر صفت ها","attributevalues"),

    $submenus = [
      xSubmenu("دسته بندی ها", "categories"),
      xSubmenu("صفت ها", "attributes"),
      xSubmenu("سئو صفحات", "heads/create"),
      xSubmenu("پیوست ها", "attachments"),
      xSubmenu("تگ ها", "tags"),
    ];
    $attributes = Attribute::where("approved", true)->orderBy("position", "ASC")->get();

    foreach ($attributes as $attribute) {
      $submenus[] = xSubmenu($attribute->label,"attributevalues?x-conditions[attribute_id]=$attribute->id")->setTextColor("#ffd326")->setIconColor("#ffd326");
    }

    return xMenu("داده ها", $submenus);
  }

}
