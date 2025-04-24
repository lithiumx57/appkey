<?php

namespace App\Panel\Kernal;

class DefaultConfigurator implements IConfigurator
{


  public function prefix(): string
  {
    return "/";
  }

  public function isDashboardProject(): bool
  {
    return false;
  }


  public function isDebugMode(): bool
  {
    return true;
  }


  public function getUploadPrefix(): string
  {
    return "files/uploads/";
  }

  public function isAbsolutePath(): bool
  {
    return false;
  }

  public function loadmenuFromCache(): bool
  {
    return false;
  }

  public function getLanguages(): array
  {
    return [
      "fa" => "فارسی"
    ];
  }

  public function getDashboardTitle(): string
  {
    return "پنل مدیریت";
  }

  public function isActiveLog(): bool
  {
    return false;
  }


  public function getOwns(): array
  {
    return [
      'isSuperAdmin' => 'مدیر کلی',
    ];
  }

  public function getHeaderTopIcons(): array
  {
    return [
      [
        'title' => "پیام ها",
        'target' => '/messaging/index',
        'classes' => 'fa fa fa-comment-o',
        "permissions" => ["access-panel-messaging"]
      ],
//      [
//        'title' => "مدیریت فایل",
//        'target' => '/file-manager',
//        'classes' => 'fa fa-file-archive-o',
//        "permissions" => ["access-panel-filemanager"]
//      ],
      [
        'title' => "ایمیل ها",
        'target' => '/email',
        'classes' => 'fa fa-envelope',
        "permissions" => ["access-panel-email"]
      ],
      [
        'title' => "عناوین و توضیحات صفحات سایت",
        'target' => '/heads/create',
        'classes' => 'fa fa-list-alt',
        "permissions" => ["access-panel-heads"]
      ],
    ];
  }


  public function getSwitchableTexts(): array
  {
    return [
      'switchable' => [xTranslate("فعال"), xTranslate("غیر فعال")]
    ];
  }

  public function getPages(): array
  {
    dd("asd");
    return [
      "home" => 'صفحه اصلی',
    ];
  }

  public function getSmsMessaging(): array
  {
    return [
      'kaveh_negar' => [
        'api_key' => '',
        'phone' => "",
        'default_receiver' => '09371370876'
      ]
    ];
  }


  public function getSuccessMessage(): string
  {
    return "عملیات با موفقیت انجام شد";
  }

  public function getErrorMessage(): string
  {
    return "خطایی رخ داده است";
  }

  public function customRoutes(): array
  {
    return [
//      [
//        "method" => "get",
//        "uri" => "product-attribute-values",
//        "target" => [\App\Http\Controllers\ProductattributevaluesController::class, "index"]
//      ]
    ];
  }

  public function getMiddlewares(): array
  {
    return [
      "web"
    ];
  }

  public function getUpdateServer(): string
  {
    return "https://panel.limaster.ir";
  }

  public function getDomainName(): string
  {
    return "";
  }

  public function getDashboardViewPath(): string
  {
    return "panel.release";
  }


  /**
   * viewPath with `.` separator
   * @return string
   */
  public function injectStylesFiles(): string
  {
    return "";
  }

  /**
   * viewPath with `.` separator
   * @return string
   */
  public function injectScripsFiles(): string
  {
    return "";
  }

  public function useLivewire(): bool
  {
    return false;
  }

  public function getDefaultlanguage(): string
  {
    return "fa";
  }

  public function getStoragePath(): string
  {
    return $this->getUploadPrefix();
  }

  public function getCdnDir(): string|null
  {
    return null;
  }

  public function getCdnWebsite(): string|null
  {
    return null;
  }

  public function getEscapeModelsRoutes(): array
  {
    return [
      "login", "panel","register-first-user",
      "profile",
//    "attachment-upload","attachments-dialog","attachments-dialog/delete",
      "media-upload", "media-dialog", "media-dialog/delete",
    ];
  }
}

