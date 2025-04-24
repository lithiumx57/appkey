<?php

namespace App\Panel\Controllers;

use App\Panel\helpers\XFileHelper;
use App\Panel\Models\Attachment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\Drivers\Gd\Encoders\PngEncoder;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class AttachmentsController extends XController
{
  public function deleteItem(): array
  {
    Paginator::currentPageResolver(function () {
      return 1;
    });

    $id = request()->input("id");
    $attachment = Attachment::find($id);

    $attachment->removeFiles();
    if ($attachment instanceof Attachment) $attachment->delete();
    return $this->getList();
  }

  public function getList(): array
  {
    $count = request()->input('count', 12);
    $attachments = Attachment::latest()->paginate($count);
    $records = [];

    foreach ($attachments as $attachment) {
      $records[] = [
        "id" => $attachment->id,
        "title" => $attachment->title,
        "link" => $attachment->getLink(),
        "type" => $attachment->type,
        "extensions" => $attachment->extensions,
        "sizes" => $attachment->sizes,

      ];
    }

    return [
      "records" => $records,
      "total" => $attachments->total(),
      "lastPage" => $attachments->lastPage(),
      "currentPage" => $attachments->currentPage(),
    ];
  }


  public function upload(Request $request): JsonResponse
  {
    if (!getConfigurator()->isDebugMode()) {
      if (!auth()->check()) return new JsonResponse(["authenticated" => false]);
      if (!auth()->user()->is_admin) return new JsonResponse(["authenticated" => false]);
    }


    $sizes = $request->header("sizes");
    $extensions = $request->header("extensions");

    $sizes = json_decode($sizes);
    $extensions = json_decode($extensions);
    $prefix = 'files/attachments';
    $uploadPath = $request->header("upload-path");

    if ($uploadPath) $prefix .= "/{$uploadPath}";

    $defaultPath = public_path($prefix);
    $cdnDir = getConfigurator()->getCdnDir();
    if ($cdnDir) {
      $defaultPath = $cdnDir . DIRECTORY_SEPARATOR . $prefix;
    }

    if (!file_exists($defaultPath)) XFileHelper::mkdirs(getConfigurator()->getCdnDir() ? $defaultPath : public_path($defaultPath));


    $file = $request->file('file');
    $unique = uniqid();
    $name = $unique . '_' . trim($file->getClientOriginalName());

    $uploadedFile = $file->move($defaultPath, $name);


    $formats = [
      'jpg' => new JpegEncoder(quality: 90),
      'png' => new PngEncoder(),
      'webp' => new WebpEncoder(quality: 90)
    ];

    $records = [];
    foreach ($extensions as $extension) {
      if (isset($formats[$extension])) $records[$extension] = $formats[$extension];
    }


    $filePath = $defaultPath . "/" . $name;
    $result = $this->prepare($filePath, $records, $sizes);

    Attachment::create([
      "title" => str_replace("." . $file->getClientOriginalExtension(), "", $file->getClientOriginalName()),
      "sizes" => $sizes,
      "unique" => $unique,
      "extensions" => array_keys($records),
      "path" => $result["images"],
      "prefix" => $result["prefix"],
      "type" => count($records) > 0 ? Attachment::TYPE_IMAGE : Attachment::TYPE_VIDEO,
    ]);
    unlink($uploadedFile->getRealPath());

    return response()->json([
      'name' => $name,
      'original_name' => $file->getClientOriginalName(),
    ]);
  }

  /**
   * @throws Exception
   */
  private function prepare($filePath, $extensions, $sizes, $keepMainFile = false): array
  {
    if (!File::exists($filePath)) throw new Exception("فایل یافت نشد");
    $manager = new ImageManager(new Driver());
    $image = $manager->read($filePath);
    $originalFileName = pathinfo($filePath, PATHINFO_FILENAME);


    $datePath = date('Y/m');
    if (getConfigurator()->getCdnDir()) {
      $outputPath = getConfigurator()->getCdnDir() . DIRECTORY_SEPARATOR . $datePath . "/";
    } else {
      $outputPath = getConfigurator()->getUploadPrefix() . $datePath . "/";
    }

    if (!File::exists($outputPath)) XFileHelper::mkdirs($outputPath);

    $generatedFiles = [];

    foreach ($extensions as $extension => $encoder) {
      foreach ($sizes as $size) {
        $newFileName = "{$size}_{$originalFileName}.{$extension}";
        $savePath = $outputPath . $newFileName;
        $resizedImage = clone $image;
        if ($size) $resizedImage->scale(width: $size);
        $encodedImage = $resizedImage->encode($encoder);
        File::put($savePath, $encodedImage);
        $generatedFiles[] = $newFileName;
      }
    }

    if (getConfigurator()->getCdnDir()) {
      $cdnPath = getConfigurator()->getCdnDir();
      $outputPath = str_replace($cdnPath . DIRECTORY_SEPARATOR, "", $outputPath);
      $outputPath = str_replace($cdnPath, "", $outputPath);
    }


    return [
      "prefix" => $outputPath,
      "images" => $generatedFiles
    ];
  }
}
