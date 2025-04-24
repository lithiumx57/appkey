<?php

namespace App\Panel\Actions;

use App\Panel\helpers\XConditionsHelper;
use App\Panel\helpers\XStringHelper;

class XActionLink extends XAction
{

  public bool $isLinkMode = true;

  public function init($link): XActionLink
  {
    $this->link = buildRoute($link);
    return $this;
  }


  public function setLink($link):XActionLink
  {
    if (!XStringHelper::startWith($link, "/")) $link = "/" . $link;
    $this->link =  getAdminPrefix() . $link;
    return $this;
  }


  public function build(): void
  {
    if (count($this->conditions) > 0) {
      $this->link .= XConditionsHelper::create($this->conditions);
    }
    $this->attributes['link'] = $this->link;
  }


}
