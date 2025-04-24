<?php


namespace App\Panel\Requests;


use App\Panel\Exceptions\XPanelException;
use App\Panel\Language\Language;
use App\Panel\Requests\Handler\XCkeditor;
use App\Panel\Requests\Handler\XCopy;
use App\Panel\Requests\Handler\XCreate;
use App\Panel\Requests\Handler\XCustomOption;
use App\Panel\Requests\Handler\XEdit;
use App\Panel\Requests\Handler\XGalleryHandler;
use App\Panel\Requests\Handler\XPanel;
use App\Panel\Requests\Handler\XPopup;
use App\Panel\Requests\Handler\XSelect;
use App\Panel\Requests\Handler\XShow;
use App\Panel\Requests\Handler\XSort;
use App\Panel\Requests\Handler\XStore;
use App\Panel\Requests\Handler\XDelete;
use App\Panel\Requests\Handler\XIndex;
use App\Panel\Requests\Handler\XUpdate;
use App\Panel\Requests\Handler\XUploader;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;

class XObject
{
  public static function store()
  {
    return XStore::initialize();
  }

  public static function delete($id, $model = null): array
  {
    return XDelete::initialize($id, $model);
  }

  public static function update($id)
  {
    return XUpdate::initialize($id);
  }


  /**
   * @throws XPanelException
   */
  public static function index()
  {
    return XIndex::initialize();
  }

  public static function show($id)
  {
    return XShow::initialize($id);
  }

  public static function create(): View
  {
    return XCreate::initialize();
  }

  public static function edit($id): View
  {
    return XEdit::initialize($id);
  }

  public static function handleGallery(): array
  {
    return XGalleryHandler::init();
  }

  public static function popup(): array
  {
    return XPopup::init();
  }

  public static function selectAction(): array
  {
    return XSelect::init();
  }

  public static function copy($id)
  {
    return XCopy::initialize($id);
  }

  /**
   * @throws XPanelException
   */
  public static function panel(): View|Factory|Application|bool|Redirector|\Illuminate\View\View|RedirectResponse|\Illuminate\Contracts\Foundation\Application|null
  {
    return XPanel::initialize();
  }

  public static function sort(): array
  {
    return XSort::initialize();
  }

  public static function customOption(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    return XCustomOption::initialize();
  }

  public static function uploadFile(): array
  {
    return XUploader::initialize();
  }

  public static function ckeditor(): array
  {
    return XCkeditor::initialize();
  }

  public static function changeLanguage($lang)
  {
    $langs = getConfigurator()->getLanguages();
    if (isset($langs[$lang])) {
      $key = auth()->user()->id . "_lang";
      Language::setLanguage($lang,"dashboard");
      cache()->put($key, $lang, Carbon::now()->addYears(5));
      return back();
    }
    abort(404);
  }


}
