<?php

namespace App\Panel\Database;

use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;


class DbMOver
{
  private string $firstConnection;
  private string $firstTable;

  private string $secondConnection;
  private string $secondTable;

  private array $columns = [];
  private array $additionalFields = [];
  private array $buildedColumns = [];

  private array $truncates = [];


  private static ?DbMover $instance = null;

  public static function getInstance(): DbMover
  {
    if (self::$instance == null) self::$instance = new DbMover();
    return self::$instance;
  }



  public function from($table, $connection = "mysql"): DbMover
  {
    $this->firstConnection = $connection;
    $this->firstTable = $table;
    return $this;
  }

  public function to($table, $connection = "mysql"): DbMover
  {
    $this->secondConnection = $connection;
    $this->secondTable = $table;
    return $this;
  }

  #[NoReturn]
  public function build(): void
  {
    $records = DB::connection($this->firstConnection)->table($this->firstTable)->paginate(20000);

    $this->buildTruncates();

    $insertedColumn = 0;
    $requestedColumn = 0;

    foreach ($records as $record) {
      $requestedColumn++;
      $row = DB::connection($this->secondConnection)->table($this->secondTable)->where("id", $record->id)->first();
      if ($row) continue;
      $insertedColumn++;

      $this->buildColumns($record);

      $this->buildAdditionalColumns();
      DB::connection($this->secondConnection)->table($this->secondTable)->insert($this->buildedColumns);
    }


    exit("inserted " . $insertedColumn . " from " . $requestedColumn);
  }


  private function buildTruncates(): void
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    foreach ($this->truncates as $truncate) DB::connection($this->secondConnection)->table($truncate)->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

  private function buildColumns($record): void
  {
    $record = (array)$record;
    foreach ($record as $key => $value) {
      if (!array_key_exists($key, $this->columns)) continue;
      $this->buildedColumns[$this->columns[$key]] = $value;
    }
  }

  private function buildAdditionalColumns(): void
  {
    foreach ($this->additionalFields as $key => $value) {
      $this->buildedColumns[$key] = $value;
    }
  }


}
