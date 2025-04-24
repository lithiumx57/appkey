<?php


namespace App\Panel\UiHandler;


class XFormError {
  public static function render($errors): string
  {
    $result = "";
    if ($errors->any()) {
      $result .= '<div class="col-md-8 col-xs-12">
                   <ul class="alert alert-danger admin-error">';
      foreach ($errors->all() as $row) {
        $result .= '<li>' . $row . '</li>';
      }
      $result .= "</ul></div>";
    }
    return $result;
  }
}
