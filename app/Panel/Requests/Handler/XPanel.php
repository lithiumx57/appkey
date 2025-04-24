<?php


namespace App\Panel\Requests\Handler;


use App\Panel\Database\DbHelper;
use App\Panel\Exceptions\XPanelException;
use App\Panel\helpers\XFileHelper;
use App\Panel\Models\PanelMenu;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class XPanel
{


  /**
   * @throws XPanelException
   */
  public static function initialize()
  {
    if (getConfigurator()->isDebugMode()) return self::handle();
    else {
      if (xHasPermission("panels-access")) return view(getConfigurator()->getDashboardViewPath());
      else abort(404);
    }
  }


  /**
   * @throws XPanelException
   */
  private static function handle()
  {

    try {
      DB::connection(env("DB_CONNECTION"))->table('users')->first();
    } catch (QueryException $e) {
      xError("پیدا نشد users بانک اطلاعاتی یافت نشد یا جدول ");
    }

    $type = getXRequest("type");
    if ($type == "roles") {
      return DbHelper::generateRolesTable();
    } else if ($type == "update-menus") {
      PanelMenu::releaseMenus();
      return back();
    } else if ($type == "attachments") {
      return DbHelper::generateAttachmentsTable();
    } else if ($type == "onlines") {
      return DbHelper::generateOnlinesTable();
    } else if ($type == "notifications") {
      return DbHelper::generateNotificationsTable();
    } else if ($type == "panel-menus") {
      return DbHelper::generatePanelMenusTable();
    } else if ($type == "languages") {
      return DbHelper::generateLanguagesTable();
    } else if ($type == "owns") {
      return DbHelper::initOwns();
    } else if ($type == "logs") {
      return DbHelper::generatePanelModels();
    } else if ($type == "heads") {
      return DbHelper::generateHeadsTables();
    } else if ($type == "add-fa") {
      return XFileHelper::generateFaDir();
    } else if ($type == "tags") {
      return DbHelper::generateTagsTable();
    } else if ($type == "themes") {
      return DbHelper::themes();
    } else if ($type == "user-model") {
      return XFileHelper::publishUser();
    } else if ($type == "publish-x-admin") {
      return XFileHelper::publishAdminFolder();
    }

    if (!auth()->check()) {
      return redirect("/login");
    }

    if (request()->input("renderType") && request()->input("renderType") == "partial") return view('panel.debug-partial');
    return view('panel.debug');
  }


}
