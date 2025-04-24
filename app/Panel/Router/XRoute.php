<?php


namespace App\Panel\Router;



use App\Panel\helpers\XStringHelper;

class XRoute {

  private ?string $model = null;
  private static ?XRoute $xroute = null;


  public static function with(string $model): XRoute
  {
    if (self::$xroute == null)
      self::$xroute = new XRoute();

    self::$xroute->model = $model;
    return self::$xroute;
  }


  public function create(): string
  {
    return "sd";
  }

  public function edit()
  {

  }


  public function index():string
  {
    $route = \App\Panel\helpers\ModelHelper::convertModelToRoute($this->model);
    return  buildRoute($route);
  }


  public function delete()
  {

  }


  public function isCreate()
  {

  }

  public function isTrash()
  {

  }

  public function isEdit()
  {

  }

  public function isIndex(): bool
  {
    $uri = request()->getRequestUri();
    $result = explode("?", $uri)[0];
    return XStringHelper::hasString($result, $this->index());
  }

}
