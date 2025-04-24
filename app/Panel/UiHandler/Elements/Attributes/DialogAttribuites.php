<?php

namespace App\Panel\UiHandler\Elements\Attributes;

use App\Panel\UiHandler\XFieldHelper;

trait DialogAttribuites
{
  function dialogMode($path = null)
  {
    if ($path == null)
      $path = [];
    else $path = [$path];
    $this->view->dialogMode=$path;
    return $this;
  }


  public function getDialogMode($record,$name):?string
  {
    $rand = rand(0, 99999999999999999);
    return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#' . $name . $rand.'">
        مشاهده
      </button>
      <div class="modal fade" id="'. $name . $rand.'" tabindex="-1" role="dialog" aria-labelledby="asd" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">' . XFieldHelper::getTdLabel($this) . '</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="">
              ' . $this->getViewer($record) . '
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
            </div>
          </div>
        </div>
      </div>';
  }

}
