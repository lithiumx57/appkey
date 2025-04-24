<?php


namespace App\Panel\Search;


use Illuminate\Database\Eloquent\Builder;

class XSearchBuilder
{
  private static ?XSearchBuilder $instance = null;
  private bool $isJoin = false;
  private string $keywrod = "";

  private array $columns = [];

  private array $modelData = [

  ];

  public static function with(string $model, $keyword, array $columns)
  {
    self::$instance = new XSearchBuilder();
    self::$instance->isJoin = false;
    self::$instance->keywrod = $keyword;
    self::addToModelData($model, $columns);
    return self::$instance;
  }


  private static function addToModelData($class, $columns = [], $firstCondition = null, $secondCondition = null)
  {
    foreach ($columns as $row) self::$instance->columns[] = $row;
    $data["model"] = $class;
    if ($firstCondition) $data["firstCondition"] = $firstCondition;
    if ($secondCondition) $data["secondCondition"] = $secondCondition;
    self::$instance->modelData[] = $data;
  }

  public function join(string $model, $firstCondition, $secondCondition, array $columns)
  {
    $this->isJoin = true;
    self::addToModelData($model, $columns, $firstCondition, $secondCondition);
    return $this;
  }


  private static function getBaseJoin()
  {
    $query = self::$instance->modelData[0];
    for ($i = 1; $i < count(self::$instance->modelData); $i++) {
      $modelData = self::$instance->modelData[$i];
      $model = $modelData["model"];
      if ($i == 1) {
        $query = $query["model"]::join($model, $modelData["firstCondition"], $modelData["secondCondition"]);
      } else {
        $query = $query->join($model, $modelData["firstCondition"], $modelData["secondCondition"]);
      }
    }
    return $query;
  }


  public function build(Builder $records = null): Builder
  {
    if ($this->isJoin) {
      $baseQuery = self::getBaseJoin();
    } else {
      $baseQuery = self::$instance->modelData[0]["model"]::query();
    }

    $keyword = self::$instance->keywrod;
    if ($keyword == null || trim($keyword) == "") {
      if ($records == null) $records = $this->modelData[0]["model"]::query();
      return $records;
    }

    return $baseQuery->where(function (Builder $query) use ($keyword) {
      $keywordArray = explode(" ", $keyword);
      $i = 0;
      foreach (self::$instance->columns as $row) {
        $i++;
        $mode = $i == 1 ? "where" : "orwhere";
        $query->$mode(function (Builder $builder) use ($keywordArray, $row) {
          foreach ($keywordArray as $row2) {
            $builder->where($row, "LIKE", "%" . $row2 . "%");
          }
        });
      }
    });
  }

}
