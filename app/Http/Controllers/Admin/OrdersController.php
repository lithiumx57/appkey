<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Panel\Controllers\XController;
use Illuminate\Http\Request;

class OrdersController extends XController
{
  public function index()
  {
    return view('admin.orders.orders-page');
  }
}
