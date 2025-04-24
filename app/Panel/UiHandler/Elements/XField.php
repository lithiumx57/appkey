<?php

namespace App\Panel\UiHandler\Elements;

class XField
{

  private static ?XField $instance = null;

  private function __construct()
  {
  }

  public static function getInstance()
  {
    if (self::$instance == null) self::$instance = new XField();
    return self::$instance;
  }


  public function text(string $name): XText
  {
    return (new XText())->get($name);
  }

  public function bool(string $name): XBool
  {
    return (new XBool())->get($name);
  }

  public function string(string $name): XString
  {
    return (new XString())->get($name);
  }

  public function attachment(string $name): XAttachment
  {
    return (new XAttachment())->get($name);
  }

  public function mediaChooser(string $name): XMediaChooser
  {
    return (new XMediaChooser())->get($name);
  }


  public function fontAwesome(string $name): XFontAwesome
  {
    return (new XFontAwesome())->get($name);
  }


  public function custom(string $name): XCustom
  {
    $result= (new XCustom())->get($name);
    $result->role->nullable=true;
    return  $result;
  }


  public function permission(string $name): XPermission
  {
    return (new XPermission())->get($name);
  }


  public function email(string $name): XEmail
  {
    return (new XEmail())->get($name);
  }


  public function password(string $name): XPassword
  {
    return (new XPassword())->get($name);
  }


  public function manyToMany(string $relationMethod, string $className, $renderField): XManyToMany
  {
    return (new XManyToMany())->get($relationMethod)->prepare($relationMethod, $className, $renderField);
  }

//  public function hasMany(string $name, string $className, $relation,$renderField): XManyToMany
//  {
//    return (new XManyToMany())->get()->prepare($relationMethod, $className, $renderField);
//  }


  public function cedarMap($name):XCedarmap
  {
    return (new XCedarmap())->get($name);
  }

//
//  public function date(string $name): XDate
//  {
//    return (new XDate())->get($name);
//  }
//
//


  public function hidden(string $name): XHidden
  {
    return (new XHidden())->get($name);
  }

  public function image(string $name): XImage
  {
    return (new XImage())->get($name);
  }

  public function dynamicText(string $name): XDynamicText
  {
    return (new XDynamicText())->get($name);
  }


  public function tag(string $name): XTag
  {
    return (new XTag())->get($name);
  }

  public function select(string $name): XSelect
  {
    return (new XSelect())->get($name);
  }

  public function td($key, $value): XTd
  {
    return (new XTd())->get(rand(0, 99999999999))->prepare($key, $value);
  }

  public function price(string $name): XPrice
  {
    return (new XPrice())->get($name);
  }

  public function date(string $name): XDate
  {
    return (new XDate())->get($name);
  }


  /**
   * @param string $name //
   *نام این فیلد در دیتابیس
   * @param string $model
   * مدل مدلی که می خواهید با آن رابطه برقرار کنید
   * @param string $relationMethod
   * متدی در همین کلاس که رابطه را ایجاد می کند
   * @param $renderFields
   * این فیلد به صورت تکی و آرایه می تواند وارد شود برای رندر کردن مقدار
   * @return XForeign
   */
  public function foreign(string $name, string $model, string $relationMethod, $renderFields): XForeign
  {
    $result = (new XForeign())->get($name);
    $result->query->model = $model;
    $result->query->relation = $relationMethod;
    if (is_string($renderFields)) {
      $renderFields = [$renderFields];
    }
    $result->query->renderFields = $renderFields;
    return $result;
  }


  public function group($fields = null): XGroup
  {
    return (new XGroup())->get("")->fields($fields);
  }


  public function br()
  {
    return (new XFieldHtmlElement())->get("")->field("<br>");
  }

  public function hr()
  {
    return (new XFieldHtmlElement())->get("")->field("<hr>");
  }

  public function time($name): XTime
  {
    return (new XTime())->get($name);
  }


  public function number($name): XNumber
  {
    return (new XNumber())->get($name);
  }

  public function uploader($name): XUploader
  {
    return (new XUploader())->get($name);
  }

  public function timestamps($name): XTimestamps
  {
    return (new XTimestamps())->get($name);
  }

  public function fileManager($name): XFileManager
  {
    return (new XFileManager())->get($name);
  }

  public function color($name): XColor
  {
    return (new XColor())->get($name);
  }

  public function simpleText($text): XSimpleText
  {
    return (new XSimpleText())->get(rand(0, 999999999))->label($text)->nullable();
  }

  public function switchable($name):XSwitchable
  {
    return (new XSwitchable())->get($name);
  }

}
