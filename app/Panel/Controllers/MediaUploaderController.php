<?php

namespace App\Panel\Controllers;

use App\Panel\helpers\XFileHelper;
use App\Panel\Models\Attachment;
use App\Panel\UiHandler\Elements\XMediaChooser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\Drivers\Gd\Encoders\PngEncoder;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class MediaUploaderController extends XController
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
    $count = request()->input('count', 18);
    $attachments = Attachment::latest()->paginate($count);
    $records = [];

    foreach ($attachments as $attachment) {
      $records[] = [
        "id" => $attachment->id,
        "name" => $attachment->title,
        "link" => $attachment->getLink(),
        "type" => $attachment->type,
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
      if (!auth()->user()->isAdmin()) return new JsonResponse(["authenticated" => false]);
    }
    $file = request()->file("file");
    $prefix = 'files/media/' . Carbon::now()->format('Y') . "/" . Carbon::now()->format('m') . "/";
    $defaultPath = public_path($prefix);
    $cdnDir = getConfigurator()->getCdnDir();
    if ($cdnDir) $defaultPath = $cdnDir . DIRECTORY_SEPARATOR . $prefix;

    if (!file_exists($defaultPath)) XFileHelper::mkdirs(getConfigurator()->getCdnDir() ? $defaultPath : public_path($defaultPath));


    $unique = uniqid();
    $fileTitleWithoutExtension=strtolower(str_replace(".".$file->getClientOriginalExtension(), "", $file->getClientOriginalName()));
    $fileTitle = createSlug(Attachment::class, $fileTitleWithoutExtension).".".strtolower($file->getClientOriginalExtension());
    $name = $unique . '_' . trim($fileTitle);
    $file->move($defaultPath, $name);


    $fileTitleWithoutExtension=strtolower(str_replace(".".$file->getClientOriginalExtension(), "", $file->getClientOriginalName()));
    $fileTitle = createSlug(Attachment::class, $fileTitleWithoutExtension);

    Attachment::create([
      "name" => strtolower(str_replace("." . $file->getClientOriginalExtension(), "", $fileTitle)),
      "unique" => $unique,
      "prefix" => "media",
      "extension" => strtolower($file->getClientOriginalExtension()),
      "type" => XMediaChooser::isVideo($file->getClientOriginalName()) ? "video" : "image",
      "created_at" => Carbon::now()->toDateTimeString(),
    ]);


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
