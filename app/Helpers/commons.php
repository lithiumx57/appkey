<?php


use App\Helpers\XArray;
use App\Infrastructure\Cart\CartManager;
use App\Infrastructure\Validation\Validation;
use App\Panel\Models\Attachment;
use App\View\Ui\AttachmentLoader;
use App\View\Ui\ImageLoader;
use Kavenegar\KavenegarApi;

function send($code, $mobile): void
{
  try {
//    $api = new KavenegarApi(env("KAVEH_NEGAR_API"));
//    $api->VerifyLookup($mobile, $code, null, null, "verify");
  } catch (Exception $exception) {
  }
}


function getProduct($productId): \App\Models\Product
{
  return \App\Helpers\Singleton\ProductSingleton::get($productId);
}

function getPrice($priceId): \App\Models\Price
{
  return \App\Helpers\Singleton\PriceSingleton::get($priceId);
}


function buildImagePaths($prefix, $paths, $default): string|null
{
  return ImageLoader::buildHtml($prefix, $paths, $default);
}

function buildAttachmentPaths(Attachment|null $attachment, $size, $extensions, $uploadPath, $fileName): string|null
{
  return AttachmentLoader::buildHtml($attachment, $size, $extensions, $uploadPath, $fileName);
}


function buildCdnPath($path): string
{
  if (!\App\Panel\helpers\XStringHelper::startWith($path, "/")) {
    $path = "/" . $path;
  }

  if (config("developer.isLocal")) {
    return config("developer.cdn.localPath") . $path;
  } else {
    return config("developer.cdn.serverPath") . $path;
  }
}

function buildCdnDir($path): string
{
  return str_replace("app-key", "", base_path()) . $path;
}

function xArray(): XArray
{
  return XArray::getInstance();
}


function cart(): CartManager
{
  return CartManager::getInstance();
}

function convertToEnglishDigit($string): string
{
  return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9'));
}

function toast($component, string $message, $type = "success" | "error" | "categories", int $time = 4): void
{
  $component->dispatch("toast", [
    "message" => $message,
    "type" => $type,
    "time" => $time
  ]);
}


function validate(): Validation
{
  return Validation::getInstance();
}


function combineArraysWithKeys($arrays, $keys, $prefix = []): array
{
  $result = [];
  if (empty($arrays)) {
    $result[] = $prefix;
    return $result;
  }
  $firstArray = array_shift($arrays);
  $firstKey = array_shift($keys);

  foreach ($firstArray as $value) {
    $newPrefix = $prefix;
    $newPrefix[$firstKey] = $value; // مقدار با کلید ذخیره شود
    $result = array_merge($result, combineArraysWithKeys($arrays, $keys, $newPrefix));
  }

  return $result;
}


function getAssestVersion(): int
{
  return rand(0, 999999999999);
}


function getTheme(): string
{
  $cookies = $_SERVER["HTTP_COOKIE"] ?? '';
  $theme = null;

  try {
    if (!$cookies) $cookies = "";
    foreach (explode('; ', $cookies) as $cookie) {
      [$name, $value] = explode('=', $cookie, 2);
      if ($name === 'theme') {
        $theme = $value;
        break;
      }
    }
  } catch (Exception) {
  }
  return $theme ?? "dark";
}


function buildChachedImage($image): string|null
{
  try {
    if (config("developer.isLocal")) {
      return html_entity_decode($image);
    }
    return html_entity_decode(str_replace(config("developer.cdn.localPath"), config("developer.cdn.serverPath"), $image));
  } catch (Exception|Throwable|Error) {
    return null;
  }

}

function buildText($text):string|null
{
  return \App\Helpers\Html\HtmlDataExtract::init($text);
}
