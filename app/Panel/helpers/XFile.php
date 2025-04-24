<?php


namespace App\Panel\helpers;


class XFile
{
  private string $path;
  private static XFile $instance;
  private static array $files = [];
  private bool $isFile = false;
  private string $name = "";

  private const IMAGE_EXTENSIONS = ["jpg", "png", "jpeg", 'ico', 'gif', 'swf'];
  private const AUDIO_EXTENSIONS = ["mp3", "mp2", "aac", 'wav', 'mid', 'midi'];
  private const VIDEO_EXTENSIONS = ["mp4", "avi", "mwv", 'mov', '3gp', 'mkv'];
  private const ARCHIVED_EXTENSIONS = ["zip", "rar", "7z", 'gz'];

  public static function with($path): XFile
  {
    self::$instance = new XFile();
    self::$instance->path = $path;
    self::$instance->build($path);
    return self::$instance;
  }

  public static function toArray(array $fileList): array
  {
    $records = [];
    foreach ($fileList as $row) {
      $record = [];

      $record['path'] = $row->getPath();
      $record['name'] = $row->getName();
      $record['isFile'] = $row->isFile();

      $record['isImage'] = $row->isImage();
      $record['isVideo'] = $row->isVideo();
      $record['isAudio'] = $row->isAudio();

      $records[] = $record;
    }
    return $records;
  }


  public function getName(): string
  {
    return $this->name;
  }

  public function isFile(): bool
  {
    return $this->isFile;
  }

  public function isDir(): bool
  {
    return !$this->isFile;
  }

  public function getPath(): string
  {
    $result = str_replace("\\", "/", $this->path);
    $result = str_replace("//", "/", $result);
    return str_replace("//", "/", $result);
  }

  public function fileList(): array
  {
    $files = glob($this->path . "/*");

    $initedDirectories = [];
    $initedFiles = [];

    foreach ($files as $file) {
      $instance = new XFile();
      $build = $instance->build($file);
      $build->isFile() ? $initedFiles[] = $build : $initedDirectories[] = $build;
    }

    self::$files = array_merge($initedDirectories, $initedFiles);
    return self::$files;
  }


  public function build($file = null): XFile
  {
    if ($file == null) $file = $this->path;
    else $this->path = $file;
    $this->isFile = !is_dir($file);
    $name = explode("/", $file);
    $this->name = $name[count($name) - 1];
    return $this;
  }

  public function isImage(): bool
  {
    foreach (self::IMAGE_EXTENSIONS as $row) {
      if (strtolower($this->getExtension()) == $row) return true;
    }
    return false;
  }

  public function isAudio(): bool
  {
    foreach (self::AUDIO_EXTENSIONS as $row) {
      if (strtolower($this->getExtension()) == $row) return true;
    }
    return false;
  }


  public function isVideo(): bool
  {
    foreach (self::VIDEO_EXTENSIONS as $row) {
      if (strtolower($this->getExtension()) == $row) return true;
    }
    return false;
  }

  public function isArchived(): bool
  {
    foreach (self::ARCHIVED_EXTENSIONS as $row) {
      if (strtolower($this->getExtension()) == $row) return true;
    }
    return false;
  }


  public function getExtension()
  {
    if (!$this->isFile()) return null;
    $extension = explode(".", $this->getName());
    return $extension[count($extension) - 1];
  }

  public function download()
  {

  }


}
