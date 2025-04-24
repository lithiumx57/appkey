<?php

use App\Helpers\DashboardConfigurator;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductattributevaluesController;
use App\Models\Admin\LoginController;
use App\Panel\Controllers\AdminController;
use App\Panel\Controllers\AttachmentsController;
use App\Panel\XDashboard;
use Illuminate\Support\Facades\Route;

XDashboard::initialize(new DashboardConfigurator());
Route::post("/attachment-upload", [AttachmentsController::class, "upload"]);

Route::get("/admin/orders", [OrdersController::class, "index"]);
Route::get("/admin/panel", [AdminController::class, "panel"]);


//Route::any("login", [AdminController::class, 'login']);
