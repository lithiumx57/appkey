<?php

namespace App\Panel\Database;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class DbHelper
{
  public static function generateRolesTable($redirect = true)
  {
    $result = self::isValidTable("roles");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createRolesTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function generateLanguagesTable($redirect = true)
  {
    $result = self::isValidTable("languages");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createLanguagesTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }

  public static function generateTagsTable($redirect = true)
  {
    $result = self::isValidTable("tags");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createTags();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function generatePanelMenusTable($redirect = true)
  {
    $result = self::isValidTable("panel_menus");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createMenusTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function generateNotificationsTable($redirect = true)
  {
    $result = self::isValidTable("notifications");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createNotificationsTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function generateOnlinesTable($redirect = true)
  {
    $result = self::isValidTable("onlines");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createOnlinesTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }

  public static function generateAttachmentsTable($redirect = true)
  {
    $result = self::isValidTable("attachments");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createAttachmentsTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function isValidTable($table): bool
  {
    return Schema::hasTable($table);
  }


  public static function generateHeadsTables($redirect = true)
  {
    $result = self::isValidTable("heads");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createHead();
    if ($redirect) return redirect()->route('panel');
    return null;
  }

  public static function generatePanelModels($redirect = true)
  {
    $result = self::isValidTable("panel_models");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createPanelModels();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


  public static function initOwns($redirect = true)
  {
    $result = self::isValidTable("owns");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createOwnsTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }

  public static function themes($redirect = true)
  {
    $result = self::isValidTable("backgrounds");
    if ($result) return $redirect ?redirect()->route('panel'):null;
    XDbTables::createThemesTable();
    if ($redirect) return redirect()->route('panel');
    return null;
  }


}
