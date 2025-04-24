<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use Throwable;

class ProfileController extends Controller
{

  public function route($method = null, $p1 = null, $p2 = null, $p3 = null)
  {
    $user = auth()->user();
    if (!$user) return redirect("/auth?back=" . request()->getRequestUri());
    try {
//      if (!$method) $method = "index";
//      $result = explode("-", $method);
//      $m = $result[0];
//      foreach ($result as $key => $value) {
//        if ($key < 1) continue;
//        $m .= ucfirst($value);
//      }
      return $this->index($method,$p1, $p2, $p3);
    } catch (Exception|Error|Throwable) {
      abort(404);
    }
  }

  public function index($path,$p1=null,$p2=null,$p3=null)
  {
    return view('pages.profile',compact('path','p1','p2','p3'));
  }
}
