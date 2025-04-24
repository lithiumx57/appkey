<?php

namespace App\Panel\Actions;

use App\Panel\Dynamic\XModel;

class XActionGenerator
{

  public function link($link = null): XActionLink
  {
    return (new XActionLink())->init($link);
  }


  public function select(array $options = []): XActionSelect
  {
    return (new XActionSelect())->setOptions($options);
  }


  public function popup(bool $isMethod = false, string $content = ""):XActionPopup
  {
    return (new XActionPopup())->init($isMethod, $content);
  }

  public function delete(XModel $model):XActionDelete
  {
    return (new XActionDelete())->initDefault($model);
  }


  public function create($link = null):XActionLink
  {
    return (new XActionLink())->init($link);
  }


  public  function edit():XActionEdit
  {
    return (new XActionEdit());
  }


}
