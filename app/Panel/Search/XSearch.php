<?php

namespace App\Panel\Search;

class XSearch
{
  private array $joins = [];
  private array $columns = [];
  private array $concat = [];


  public static function getInstance(): XSearch
  {
    return new XSearch();
  }


  public function addJoin($table, $firstColumn, $secondColumn): XSearch
  {
    $this->joins[$table] = [$firstColumn, $secondColumn];
    return $this;
  }

  public function addColumn(...$columns): XSearch
  {
    if (is_array($columns[0])) {
      $this->columns = array_merge($columns[0], $this->columns);
    } else {
      $this->columns = array_merge($this->columns, $columns);
    }
    return $this;
  }

  public function addConcatColumns($first, $second): XSearch
  {
    $this->concat[] = [$first, $second];
    return $this;
  }

  public function getConcatColumns(): array
  {
    return $this->concat;
  }

  public function getJoins(): array
  {
    return $this->joins;
  }

  public function getColumns(): array
  {
    return $this->columns;
  }


}
