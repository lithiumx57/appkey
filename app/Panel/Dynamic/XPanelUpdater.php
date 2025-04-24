<?php


namespace App\Panel\Dynamic;

use App\Panel\helpers\XFileHelper;

trait XPanelUpdater
{

  public function updatePanel():string|false
  {
    $options = array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'GET',
      )
    );
    $context = stream_context_create($options);
    return file_get_contents(getConfigurator()->getUpdateServer() . "/show-update", false, $context);
  }


  public function doUpdatePanel(): array
  {

    $path = getXRequest("path");
    $type = getXRequest("type");
    $this->confirmUpdate($path, $type);

    return [
      'status' => true
    ];

  }


  private function confirmUpdate($dexPath, $type):void
  {
    XFileHelper::download(getConfigurator()->getUpdateServer() . $dexPath, public_path("dex.zip"));
    if (file_exists(public_path("dex.zip"))) {
      $this->applyPatch($type);
    }
  }

  private function applyPatch($type):void
  {
    XFileHelper::extract(public_path("dex.zip"), public_path('temp'));
    XFileHelper::deleteDir(app_path("Panel"));
    XFileHelper::copyDir(public_path("temp"), base_path("app"));
    XFileHelper::deleteDir(public_path("temp"));
    if ($type == "full") XFileHelper::moveDir(app_path("Panel/examples/dashboard"), public_path('dashboard'));
    unlink(public_path("dex.zip"));
  }


}
