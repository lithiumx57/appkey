<?php


namespace App\Panel\helpers;


use App\Panel\FilesHandler\CdnPathHandler;
use App\Panel\FilesHandler\PathHandler;
use App\Panel\XDashboard;
use Dflydev\DotAccessData\Data;
use Error;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class XFileHelper
{

  public static function copyDir($path, $target)
  {
    $dir = opendir($path);
    @mkdir($target);
    while ($file = readdir($dir)) {

      if (($file != '.') && ($file != '..')) {
        if (is_dir($path . '/' . $file)) {
          self::copyDir($path . '/' . $file, $target . '/' . $file);

        } else {
          copy($path . '/' . $file, $target . '/' . $file);
        }
      }
    }
    closedir($dir);
  }

  public static function getExamplesFolder()
  {
    return app_path("Panel/examples");
  }

  public static function getModelFolder()
  {
    return base_path() . "/app/" . str_replace("\\", "/", MODEL_PREFIX);
  }

  public static function publishAdminFolder()
  {
    $zip = new ZipArchive;
    if ($zip->open(self::getExamplesFolder() . "/admin.zip") === true) {
      $zip->extractTo(public_path());
      $zip->close();
      return redirect()->route('panel');
    } else {
      echo 'ERROR';
    }
  }

  public static function extract($path, $target)
  {
    $zip = new ZipArchive;
    if ($zip->open($path) === true) {
      $zip->extractTo($target);
      $zip->close();
      return redirect()->route('panel');
    } else {
      die('ERROR');
    }
  }

  public static function deleteDir($dirPath)
  {
    if (!is_dir($dirPath)) return;
    foreach (scandir($dirPath) as $row) {
      if ($row == "." || $row == "..") continue;

      $path = $dirPath . DIRECTORY_SEPARATOR . $row;

      if (is_dir($path)) {
        self::deleteDir($path);
      } elseif (is_file($path)) {
        unlink($path);
      } else {
        continue;
      }
    }

    rmdir($dirPath);
  }


  public static function publishUser()
  {
    File::copy(self::getExamplesFolder() . "/User.txt", base_path() . "/app/Models/User.php");
    return back();
  }

  public static function generateFaDir()
  {
    $dest = lang_path("fa");
    if (!is_dir($dest)) static::mkdirs(lang_path("fa"));
    dd($dest);
    $src = self::getExamplesFolder() . DIRECTORY_SEPARATOR . "fa";
    foreach (scandir($src) as $file) {


      if (!is_readable($src . DIRECTORY_SEPARATOR . $file)) continue;
      if ($file == "." || $file == "..") continue;

      $src = str_replace("/", DIRECTORY_SEPARATOR, $src);
      $src = str_replace("\\", DIRECTORY_SEPARATOR, $src);
      File::copy($src . DIRECTORY_SEPARATOR . $file, $dest . DIRECTORY_SEPARATOR . $file);
    }

    return redirect(buildRoute("panel"));
  }

  public static function download($path, $target)
  {
    file_put_contents($target, fopen($path, 'r'));
  }


  public static function getDirectoryChildren($path): array
  {
    $result = [];
    $files = array_diff(scandir($path), array('.', '..'));
    foreach ($files as $file) {
      $filePath = $path . DIRECTORY_SEPARATOR . $file;
      if (is_file($filePath)) {
        $result[] = $filePath;
      } else if (is_dir($filePath)) {
        $result = array_merge($result, self::getDirectoryChildren($filePath));
      }
    }

    return $result;
  }

  public static function deleteFile($fileOrFiles, $dir = null): void
  {
    if ($fileOrFiles == null) return;
    if (is_string($fileOrFiles)) $fileOrFiles = [$fileOrFiles];


    foreach ($fileOrFiles as $row) {
      if ($dir != null) $row = $dir . "/" . $row;

      if (XStringHelper::startWith($row, "/")) $row = Str::substr($row, 1, strlen($row));
      if (file_exists($row) && !is_dir($row)) {
        unlink($row);
      }
    }
  }

  public static function deleteSingleFile($path): void
  {
    try {
      if (is_file($path)) {
        unlink($path);
      }
    } catch (Exception $e) {
    }
  }

  public static function getExtension($fileName): ?string
  {
    if (!$fileName)
      return null;
    $result = explode(".", $fileName);
    if (count($result) == 0)
      return null;
    return $result[count($result) - 1];

  }

  public static function createFile(string $path)
  {
    file_put_contents($path, "");
  }

  public static function initPath($path): string
  {
    $path = str_replace("/", DIRECTORY_SEPARATOR, $path);
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
    return str_replace(DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path);
  }


  public static function mkdirs(string $absolutePath): void
  {
    $cdnDir = getConfigurator()->getCdnDir();
    if ($cdnDir) CdnPathHandler::mkdirs($absolutePath);
    else PathHandler::mkdirs($absolutePath);
  }


  public static function uploadBase64($dirPath, $data): string
  {
    $dirPath = XDashboard::getConfigurator()->getUploadPrefix() . $dirPath;
    XFileHelper::mkdirs(public_path($dirPath));
    $extension = explode('/', mime_content_type($data))[1];
    $filePath = $dirPath . "/" . time() . rand(0, 999999) . "." . $extension;
    file_put_contents(public_path($filePath), ImageHelper::base64Decode($data));
    return $filePath;
  }


  public static function moveDir(string $path, string $target): void
  {
    self::copyDir($path, $target);
    self::deleteDir($path);
  }

  public static function moveFiles($image, string $target)
  {
    $result = self::copyFiles($image, $target);
    self::deleteFile($image);
    return $result;
  }

  public static function copyFiles($image, string $target)
  {
    $result = [];
    $isString = is_string($image);
    if ($isString) {
      $image = [$image];
    }

    $startWithSlash = false;
    foreach ($image as $key => $value) {
      if (XStringHelper::startWith($value, "/")) {
        $startWithSlash = true;
        $value = XStringHelper::deleteStartIndex($value, "/");
      }
      $newpath = XFileHelper::copyFile($value, $target . "/" . XFileHelper::getFileName($value));
      if ($startWithSlash) {
        $newpath = "/" . $newpath;
      }
      $result[$key] = $newpath;
    }

    if ($isString) {
      return $result[getXFirstIndexKey($result)];
    }
    return $result;
  }


  public static function copyFile($file, $target)
  {
    $dirName = str_replace("/" . self::getFileName($target), "", $target);
    if (!is_dir($dirName)) self::mkdirs($dirName);
    copy($file, $target);
    return $target;
  }

  public static function getFileName($value): ?string
  {
    $result = explode("/", $value);
    return $result[count($result) - 1];
  }


  public static function getDirectoryName(string $filePath): string
  {
    $filePath = explode("/", $filePath);
    $result = "";
    for ($i = 0; $i < count($filePath) - 1; $i++) {
      $result .= $filePath[$i] . "/";
    }
    return $result;
  }


  public static function getDirectoryPath($path, $separation = "/"): string
  {
    $result = explode($separation, $path);
    unset($result[count($result) - 1]);
    $result = join($separation, $result);
    if (XStringHelper::startWith($path, "/")) {
      return "/" . $result;
    }
    return $result;
  }


  public static function changeFileExtension($path, $newExtension): string
  {
    if (XStringHelper::hasString($newExtension, '.')) {
      $newExtension = str_replace(".", "", $newExtension);
    }
    $path = explode(".", $path);
    $finalPath = "";
    $i = 0;
    foreach ($path as $row) {
      $i++;
      if ($i == count($path)) {
        $finalPath .= "." . $newExtension;
      } else {
        $finalPath .= $row;
      }
    }

    return $finalPath;
  }


}
