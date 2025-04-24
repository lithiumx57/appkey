<?php


namespace App\Panel\Dynamic;

use Mockery\Exception\BadMethodCallException;

trait XControllerHandler
{

  public abstract function index();

  public abstract function create();

  public abstract function store(AdminRequest $request);

  public abstract function show($id);

  public abstract function edit($id);

  public abstract function update(AdminRequest $request, $id);

  public abstract function destroy(AdminRequest $request, $id);

  public function indexHandler()
  {
    return $this->index();
  }

  public function createHandler()
  {
    return $this->create();
  }

  public function storeHandler(AdminRequest $request)
  {
    return $this->store($request);
  }

  public function editHandler($id)
  {
    return $this->edit($id);
  }

  public function copyHandler($id)
  {
    return $this->copy($id);
  }

  public function updateHandler(AdminRequest $request, $id)
  {
    return $this->update($request, $id);
  }

  public function showHandler($id)
  {
    return $this->show($id);
  }

  public function destroyHandler(AdminRequest $request, $id)
  {
    $type = $request->get("type");
    if ($type && $type == "switch") {
      return  $this->multipleSwitch(self::$model);
    } else if ($type && $type == "mtm") {
      return $this->mtm();
    }

    return $this->destroy($request, $id);
  }


  public function multipleSwitch($model)
  {
    $records = getXRequest("records");
    $fillable = getXRequest("fillable");
    try {
      $result = $model::withTrashed()->whereIn('id', $records)->get();
    } catch (BadMethodCallException $e) {
      $result = $model::whereIn('id', $records)->get();
    }

    foreach ($result as $row) {
      if ($row instanceof $model) {
        $row->update([
          $fillable => !$row->$fillable
        ]);
      }
    }
    showSuccessMessage();
    return back();
  }



}
