<?php

namespace App\Helpers;

use App\Panel\Kernal\DefaultConfigurator;

class DashboardConfigurator extends DefaultConfigurator
{

  public function isDebugMode(): bool
  {
    return false;
  }


  public function getDashboardViewPath(): string
  {
    return "admin.panel";
  }


  public function prefix(): string
  {
    return "admin";
  }

  public function isDashboardProject(): bool
  {
    return false;
  }

  public function getPages(): array
  {
    return [
      "home" => 'صفحه اصلی',
    ];
  }


  public function getUpdateServer(): string
  {
    return "http://panel.local";
  }


  public function getCdnDir(): string|null
  {
    if (config("developer.isLocal")) return "E:\\xampp\\htdocs\\static.appkey.local";
    else return "/www/wwwroot/limaster/staticappkey";
  }

  public function getCdnWebsite(): string|null
  {
    if (config("developer.isLocal")) return "http://static.appkey.local";
    else return "https://static.appkey.ir";
  }

}
