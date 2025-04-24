<?php


namespace App\Panel\Language;


use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Language
{

  private static ?array $data = null;
  private static ?\App\Panel\Models\Language $language = null;

  public static function get($key, $lang = null, $type = null)
  {
    if (count(getConfigurator()->getLanguages()) == 0) {
      return $key;
    }
    self::init($lang, $type);
    if (self::$language->name == getConfigurator()->getDefaultlanguage()) {
      return $key;
    }

    $result = @self::$data[$key];
    if ($result == null) return $key;
    return $result;
  }

  public static function setLanguage($lang, $type): void
  {
    session(["DEFAULT_LANGUAGE_" . $type => $lang]);
    Session::save();
  }

  public static function getLanguage($type): string
  {

    try {
      $result = request()->session()->get("DEFAULT_LANGUAGE_" . $type);
      if ($result == null) {
        if (!auth()->check()) {
          session()->put("DEFAULT_LANGUAGE_" . $type, getConfigurator()->getDefaultlanguage());
          $result = "fa";
        } else {
          $key = auth()->user()->id . "_lang";
          $_result = cache()->get($key);
          if ($_result) {
            session()->put("DEFAULT_LANGUAGE_" . $type, $_result);
            $result = $_result;
          }
        }

      }
      return $result;
    } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface) {
      return "fa";
    }

  }


  public static function init($lang = null, $type = null): void
  {
    if ($lang == null) $lang = self::getLanguage($type);
    if (self::$data == null) {
      self::$data = self::getLanguageFile($lang, $type);
      self::$language = \App\Panel\Models\Language::getDefault($lang, $type);
    }
  }

  public static function getLanguageFile($lang = null, $type = "main")
  {
    if ($lang == null) $lang = self::getLanguage($type);

    $directoryPath = lang_path('json');
    if (!is_dir($directoryPath)) {
      mkdir($directoryPath);
    }

    $filePath = $directoryPath . DIRECTORY_SEPARATOR . $lang . "_" . $type . '.json';
    if (!is_file($filePath)) {
      fopen($filePath, "w");
    }


    $result = file_get_contents($filePath);
    return json_decode($result, true);
  }

  public static function getData($lang, $type = "main"): array
  {
    $langPath = lang_path('json' . DIRECTORY_SEPARATOR . $lang . "_" . $type . ".json");
    if (!is_file($langPath)) {
      self::createLanguage($lang, $type);
    }

    $baseRecords = self::getBaseFileData($type);
    $result = file_get_contents($langPath);
    if ($result == "" || $result == null)
      $result = json_encode([]);


    return [
      "records" => $baseRecords,
      'translate' => json_decode($result)
    ];
  }

  private static function createLanguage(string $lang, $type): void
  {
    $directoryPath = lang_path('json');
    if (!is_dir($directoryPath)) {
      mkdir($directoryPath);
    }

    $filePath = $directoryPath . DIRECTORY_SEPARATOR . $lang . "_" . $type . ".json";
    if (!is_file($filePath)) {
      $fp = fopen($filePath, 'w');
      fclose($fp);
    }
  }

  private static function getBaseDataFilePath($type): string
  {
    return app_path("Panel/Language/lang_" . $type . ".json");
  }

  private static function getBaseFileData($type): array
  {
    $baseRecords = file_get_contents(self::getBaseDataFilePath($type));
    $baseRecords = json_decode($baseRecords, true);

    if ($baseRecords == null || $baseRecords == "" || !is_array($baseRecords)) $baseRecords = [];
    return $baseRecords;
  }

  public static function storeData(): void
  {
    $records = getXRequest("lang");

    $lang = getXRequest("x-lang");
    $lang = \App\Panel\Models\Language::findOrFail($lang);

    $file = lang_path('json') . DIRECTORY_SEPARATOR . $lang->name . "_" . $lang->type . ".json";

    $keys = getXRequest("key");
    $values = getXRequest("value");
//    $newRecords = [];
    if ($keys && is_array($keys)) {
      foreach ($keys as $key => $value) {
        if ($value == null || trim($value) == "" || !isset($values[$key]) || $values[$key] == null || trim($values[$key]) == "") continue;
//        $newRecords[$value] = $values[$key];
        $records[$value] = $values[$key];
      }
    }

    $result = json_encode($records);
    self::updateBaseData($records, $lang->type);

    \App\Panel\Models\Language::where("name", $lang)->update([
      "last_update" => Carbon::now()
    ]);

    file_put_contents($file, $result);
  }

  private static function updateBaseData($records, $type): void
  {
    $baseData = [];
    if (!is_array($records)) $records = [];
    foreach ($records as $key => $value) $baseData[] = $key;
    file_put_contents(self::getBaseDataFilePath($type), json_encode($baseData));
  }


  public static function getDirection()
  {
    if (self::$language == null) self::init();
    return self::$language->direction;
  }

//  public libs function getIfHasChangeFrom($lastEnter, $languageName, $isFirstUse = false): ?\App\Panel\Models\Language
//  {
//    if ($isFirstUse) {
//      return \App\Panel\Models\Language::where("name", $languageName)->first();
//    } else {
//      return \App\Panel\Models\Language::where("name", $languageName)->where("last_update", ">", $lastEnter)->first();
//    }
//
//  }

}
