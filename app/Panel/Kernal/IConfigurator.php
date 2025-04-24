<?php

namespace App\Panel\Kernal;

interface IConfigurator
{

  public function prefix(): string;

  public function isDashboardProject(): bool;

  public function isDebugMode(): bool;

  public function getDashboardViewPath(): string;

  public function getDefaultlanguage(): string;

  public function getUploadPrefix(): string;

  public function isAbsolutePath(): bool;

  public function loadmenuFromCache(): bool;

  public function getLanguages(): array;

  public function customRoutes(): array;

  public function getDashboardTitle(): string;

  public function isActiveLog(): bool;

  public function getOwns(): array;

  public function getHeaderTopIcons(): array;

  public function getSwitchableTexts(): array;

  public function getPages(): array;

  public function getSmsMessaging(): array;

  public function getSuccessMessage(): string;

  public function getErrorMessage(): string;

  public function getMiddlewares(): array;

  public function getUpdateServer(): string;

  public function getDomainName(): string;

  public function injectStylesFiles(): string;

  public function injectScripsFiles(): string;

  public function useLivewire(): bool;

  public function getStoragePath(): string;

  public function getCdnDir(): string|null;

  public function getCdnWebsite(): string|null;

  public function getEscapeModelsRoutes(): array;

}
