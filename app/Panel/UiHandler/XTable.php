<?php


namespace App\Panel\UiHandler;


class XTable
{
  private string $result = "";

  public function init($records): string
  {
    $this->result .= "<table class='table table-bordered'>";


    foreach ($records as $row) {
      $this->result .= "<tr>";

      foreach ($row as $td) {
        $this->result .= "<td>";
        $this->result .= $td;
        $this->result .= "</td>";
      }

      $this->result .= "</tr>";
    }


    $this->result .= "</table>";
    return $this->result;
  }
}