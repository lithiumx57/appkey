<?php


namespace App\Panel\Dynamic;


use App\Panel\Controllers\XController;
use App\Panel\Kernal\XConfigurator;
use Illuminate\Routing\Controller as BaseController;

class XBaseController extends BaseController
{
  use XControllerHandler,XPanelUpdater;

  public static $model;
  public static $route;

  public static function setModel(array $model)
  {
    XConfigurator::$model = $model['class_path'];
    XController::$model = $model['class_path'];
    XController::$route = $model['resource_route'];
  }



  public function index()
  {
    return null;
  }

  public function create()
  {
    return null;
  }

  public function store(AdminRequest $request)
  {
    return null;
  }

  public function show($id)
  {
    return null;
  }

  public function edit($id)
  {
    return null;
  }

  public function update(AdminRequest $request, $id)
  {
    return null;
  }

  public function destroy(AdminRequest $request, $id)
  {
    return null;
  }

  public function copy($id)
  {
    return null;
  }


}
