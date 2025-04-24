<?php


namespace App\Panel\UiHandler\Elements\Builder;


use App\Panel\UiHandler\Elements\XGallery;

class ElementBuilder
{

  public $data = [];

  public function gallery(string $name, ...$value): XGallery
  {
    return (new XGallery())->init($name, $value);
  }

}