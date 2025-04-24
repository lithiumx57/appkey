<?php


namespace App\Panel\Requests\Handler;

use App\Panel\Controllers\AdminController;
use App\Panel\Exceptions\XPanelException;
use App\Panel\helpers\ModelHelper;
use App\Panel\Search\XSearch;
use App\Panel\Singleton\XModelSingleton;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class XIndex
{
  public static array $conditions = [];

  /**
   * @throws XPanelException
   */
  public static function initialize()
  {
    $model = AdminController::$model;
    if (XModelSingleton::getModel($model)::disable()->has("index")) {
      xAlert("دسترسی به این قسمت امکان پذیر نیست", "warning");
      return back();
    }

    $result = getXRequest("x-option-call-method");
    if (is_string($result) && $result == "true") return self::initCallMethodOption();

    if ($model::isTableOff()) return self::customView();

    if ($model::isFieldMode()) {
      $pageTitle = ModelHelper::getPluralTitle($model);
      $records = new LengthAwarePaginator([], 0, 10);
      return view('index', compact('records', 'pageTitle'));
    }


    $pageTitle = ModelHelper::getPluralTitle($model);
    self::initConditions();

    $records = self::getIndexRecords();

    return view('index', compact('records', 'pageTitle'));
  }


  public static function getIndexRecords()
  {
    if (isTrashMode()) return self::getTrashRecords();
    else return self::getRecords();
  }

  /**
   * @throws XPanelException
   */
  private static function customView(): View
  {
    $model = AdminController::$model;
    $view = $model::getIndexView();

    if ($view == null) $view = $model::$indexView;


    if ($view == null) {
      xError("متد  " . "indexView" . "در مدل" . $model . " یافت نشد ");
    }

    return view($view);
  }

  private static function initCallMethodOption()
  {
    $method = request()->input("method");
    return AdminController::$model::$method();
  }

  private static function getRecords()
  {
    $model = AdminController::$model;
    $records = $model::xQuery();

    if ($records == null) {
      $records = $model::query();

      $withData = $model::getWithRelations();
      if (is_array($withData) && count($withData) > 0) {
        $records = $records->with($withData);
      }
      $records = $records->where($model::getQueryRoles());

      self::initSort($records);
      if ($model::isActiveSearch()) $records = self::injectSearch($records, $model);
      $records = $records->where(self::$conditions)->paginate($model::$paginatePerPage);
    }
    return $records;
  }

  /**
   * @throws \App\Panel\Exceptions\XPanelException
   */
  private static function getTrashRecords()
  {
    $model = AdminController::$model;
    $records = $model::xQuery();
    if ($records == null) {
      $records = $model::where($model::getQueryRoles())->onlyTrashed();
      self::initSort($records);


      if ($model::isActiveSearch()) $records = self::injectSearch($records, $model);

      $records = $records
        ->where(self::$conditions)
        ->paginate($model::$paginatePerPage);
    }
    return $records;
  }

  /**
   * @throws \App\Panel\Exceptions\XPanelException
   */
  public static function initSort($records)
  {
    $model = AdminController::$model;
    $sortField = $model::$sortField;
    $limit = $model::$limit;

    if ($sortField) {
      errorIfTableNotFoundColumn($model, $sortField);
      $records = $records->orderBy($model::getModelTable() . "." . $sortField, "ASC");
    } else {
      $records = $records->orderBy($model::getModelTable() . '.id', 'DESC');
    }


    if ($limit != null) {
      $records = $records->limit($limit);
    }


    return $records;
  }

  private static function initConditions()
  {
    $conditions = getXRequest("x-conditions");
    if (is_array($conditions) && count($conditions) > 0) {
      self::$conditions = $conditions;
    }
  }

  private static function injectSearch(Builder $records, $model)
  {


    $keyword = request()->input("q");
    if (strlen(trim($keyword)) == 0) return $records;


    $searchBuilder = $model::searchBuilder();

    if (!($searchBuilder instanceof XSearch)) {
      return $records;
    }

    if (!($model::isActiveSearch())) return $records;

    if (count($searchBuilder->getColumns()) == 0) {
      $searchBuilder->addColumn($model::getAllFillAbles());
    }

    foreach ($searchBuilder->getJoins() as $key => $value) {
      $records->join($key, $value[0], "=", $value[1]);
    }


    $records->where(function (Builder $query) use ($searchBuilder, $keyword) {
      $keywordArray = explode(" ", $keyword);
      $i = 0;
      foreach ($searchBuilder->getColumns() as $row) {
        $i++;
        $mode = $i == 1 ? "where" : "orwhere";
        $query->$mode(function (Builder $builder) use ($keywordArray, $row) {
          foreach ($keywordArray as $row2) {
            $builder->where($row, "LIKE", "%" . $row2 . "%");
          }
        });
      }


      foreach ($searchBuilder->getConcatColumns() as $row) {
        $query->orwhere(function (Builder $builder) use ($keywordArray, $row) {
          foreach ($keywordArray as $row2) {
            $builder->where(DB::raw("CONCAT_WS(" . $row[0] . ",' '," . $row[1] . ")"), "LIKE", "%" . $row2 . "%");
          }
        });
      }


    });


    return $records;
  }
}
