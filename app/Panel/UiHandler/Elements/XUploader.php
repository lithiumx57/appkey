<?php


namespace App\Panel\UiHandler\Elements;


use App\Panel\UiHandler\Elements\Attributes\UploadAttributes;

class XUploader extends Element
{
  use UploadAttributes;
  protected string $viewPath = 'uploader';


  public function init(): void
  {
    $this->view->isMultipleTypes = true;
  }


  public function get(string $name)
  {
    $this->name = $name;
    $this->view->isMultipleTypes = true;
    $this->setDefaults();


    return $this;
  }

  public function getViewer($record)
  {
    $field = $this;
    $name = $this->name;


    return view('controls.uploader', compact('field', 'name', 'record'));
  }


  public function setMimes($mimes)
  {
//    $this->view->isMultipleTypes=true
    $this->view->mimes = $mimes;
    return $this;
  }


}
