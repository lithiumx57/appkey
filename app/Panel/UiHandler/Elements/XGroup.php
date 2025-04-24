<?php

namespace App\Panel\UiHandler\Elements;

class XGroup extends Element
{

  private ?array $elements = null;


  public function fields($elements)
  {
    $this->elements = $elements;
    return $this;
  }

  public function getElements(): ?array
  {
    return $this->elements;
  }

  public function buildChildren(): array
  {
    $count = count($this->elements);
    $col = 12 / $count;
    $records = [];
    foreach ($this->elements as $row) {
      if ($row instanceof XGroup) {
        $records = array_merge($records, $row->buildChildren());
      } else if ($row instanceof Element) {
        $row->view->col = "col-md-" . $col;
        $records[] = $row;
      }
    }

    return $records;
  }

  public function render($record = null, $isOnlyRender = false)
  {
    $elements = $this->elements;
    if ($record != null) {
      $this->record = $record;
    }
    return view('controls.group', compact('elements', 'record'));
  }
}
