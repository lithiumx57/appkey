<?php

namespace App\Panel\Controllers;

use App\Panel\Dynamic\AdminRequest;
use App\Panel\Dynamic\XSearchInBigData;
use App\Panel\Exceptions\XPanelException;
use App\Panel\helpers\XFile;
use App\Panel\Requests\Handler\LoginHandler;
use App\Panel\Requests\Handler\ProfileHandler;
use App\Panel\Requests\Handler\RegisterFrstUserHandler;
use App\Panel\Requests\XObject;
use App\Panel\UiHandler\NavigationMenu;
use App\Panel\UiHandler\ThemeManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends XController
{

  public static bool $isEditMode = false;

  /**
   * @throws XPanelException
   */
  public function index()
  {
    return XObject::index();
  }


  public function registerFirstAdmin(): Redirector|\Illuminate\Http\RedirectResponse
  {
    return RegisterFrstUserHandler::handle();
  }

  public function popupAction():array
  {
    return XObject::popup();
  }


  public function selectAction():array
  {
    return XObject::selectAction();
  }

  public function create(): View
  {
    return XObject::create();
  }


  public function store(AdminRequest $request): RedirectResponse
  {
    return XObject::store();
  }


  public function show($id)
  {
    return XObject::show($id);
  }

  public function edit($id): View
  {
    return XObject::edit($id);
  }

  public function update(AdminRequest $request, $id)
  {
    return XObject::update($id);
  }

  public function destroy(AdminRequest $request, $id): array
  {
    return XObject::delete($id);
  }

//  public function renderFileManager(): array
//  {
//    $path = getXRequest("path");
//    return XFile::toArray(XFile::with($path)->fileList());
//  }


  public function uploadFromGallery(): array
  {
    return XObject::handleGallery();
  }

  public function changeTheme(): array
  {
    $theme = getXRequest("newTheme");
    ThemeManager::switchThemeTo($theme);
    return ["status" => true, "message" => "تصویر پس زمینه با موفقیت تغییر کرد"];
  }

  public function toggleNavigationMenu(): array|null|bool
  {
    return NavigationMenu::toggleMenu();
  }

  public function copy($id): RedirectResponse
  {
    return XObject::copy($id);
  }


  public function ckUploader(): array
  {
    return XObject::ckeditor();
  }

  /**
   * @throws XPanelException
   */
  public function panel(): \Illuminate\Contracts\View\View|Application|Factory|bool|Redirector|View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|null
  {
    return XObject::panel();
  }

  public function changeLanguage($lang): ?\Illuminate\Http\RedirectResponse
  {
    return XObject::changeLanguage($lang);
  }

  public function sortRecords(): array
  {
    return XObject::sort();
  }


  public function customOption(): Application|Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
  {
    return XObject::customOption();
  }


  public function uploader():array
  {
    return XObject::uploadFile();
  }


  function searchInBigData(): array
  {
    return XSearchInBigData::init();
  }


  public function profile():View
  {
    return ProfileHandler::init();
  }


  public function login()
  {
    return LoginHandler::handle();
  }

}

