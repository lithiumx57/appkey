<?php


namespace App\Panel\Dynamic;

use App\Panel\Actions\XActionsBuilder;
use App\Panel\Dynamic\CustomSluggable\XSluggable;
use App\Panel\helpers\NavigationBuilder;
use App\Panel\helpers\XFieldMerger;
use App\Panel\helpers\XModelHelper;
use App\Panel\helpers\XObjectHandler;
use App\Panel\Menu\XMenu;
use App\Panel\Search\XSearch;
use App\Panel\UiHandler\XFieldHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

abstract class XModel extends Model
{
  use  XObjectHandler, XModelHelper,XSluggable;


  public static string $iconClass = "simple-icon-rocket";
  public static string $menuParent = "menu";
  public static bool $isRowNumbersActive = true;
  public static string $rowNumberTitle = "#";
  public static bool $contextActionMode = false;

  public static array $customPermissions = [];

  protected array $slugFields = [];

  public bool $menuOff = false;
  public static $limit = null;
  public ?string $menuIcon = null;

  public string $menuIconColor = "#ffffff";
  public string $menuTextColor = "#ffffff";

  public static $selection = true;

  public static ?string $sortField = null;
  public static $xTable = false;
  public bool $activeSearch = true;

  public static int $paginatePerPage = 10;

  public static $editObject = null;
  protected $positionTitle = -1;

  public static ?string $indexView = null;
  protected ?string $createView = null;
  protected ?string $editView = null;
  protected ?string $guide = null;
  protected int $containerColumns = 8;

  protected bool $saveButton = true;
  protected bool $saveAndBackButton = true;
  protected bool $cancelButton = true;
  public static ?string $route = null;

  protected bool $isTableOff = false;
  protected bool $fieldMode = false;
  protected $guarded = ['id'];


  protected ?string $title = null;
  protected ?string $pluralTitle = null;

  protected string $escapeQuery = "escape-query-role=true";

  protected static array $searchFields = [];


  public static function xQuery()
  {
    return null;
  }

  public function scopeGetContainerColumns()
  {
    return 'col-md-' . $this->containerColumns;
  }


  public function scopeGetSlugFields(): array
  {
    return $this->slugFields;
  }


  public function scopeGetGuide(): ?string
  {
    return $this->guide;
  }

  public function scopeGetPositionTitle(): ?string
  {
    return $this->positionTitle;
  }


  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
//    if (!Schema::hasColumn($this->table, "created_at")) {
//      $this->timestamps = false;
//    }
  }

  public function scopeHasGuide(): bool
  {
    return $this->guide != null;
  }


  public function scopeGetCreateView(): ?string
  {
    return $this->createView;
  }


  public function scopeGetXTitle(): ?string
  {
    return $this->title;
  }

  public function scopeGetXPluralTitle(): ?string
  {
    return $this->pluralTitle;
  }

  public function scopeGetEditView(): ?string
  {
    return $this->editView;
  }


  public function scopeIsTableOff(): ?bool
  {
    return $this->isTableOff;
  }

  public function scopeIsFieldMode(): ?bool
  {
    return $this->fieldMode;
  }


  public function xMenuOff(): bool
  {
    return $this->menuOff;
  }


  public abstract function fields(): array;

  public abstract function queryRoles(): array;

  abstract static function isDynamicPanelMode();

  public abstract function options(): array;

  public abstract function xPermissions(): array;

  public static abstract function getEditData();

  public abstract function trStyles();

  protected abstract function getContainerClass();

  protected abstract function xCustomView();

  protected abstract function menu(): ?XMenu;


  public function scopeGetContainerClass()
  {
    return $this->getContainerClass();
  }


  public function scopeGetModelTable()
  {
    return $this->getTable();
  }

  public function scopeGetAllFillAbles()
  {
    $this->fillable = Schema::connection($this->connection)->getColumnListing($this->getTable());
    return $this->fillable;
  }


  public function scopeGetFields($object = null): array
  {
    if ($this->isTableOff  || $this->fieldMode){
      return $this->fields();
    }
    if ($object != null) $object = $object->first();
    if ($object instanceof LiModel) {
      return $object->fields();
    }
    return $this->fields();
  }

  public function scopeGetFieldsByRecord($object = null): array
  {
    if ($object instanceof LiModel) {
      return $object->fields();
    }
    return $this->fields();
  }

  public function scopeGetExtractedFields(): array
  {
    $fieldMerger = new XFieldMerger();
    return $fieldMerger->merge($this->fields());
  }

  public function checkDepends($fields)
  {
    $temp = XFieldHelper::getMergedFields($fields);
    foreach ($temp as $row) {
      if ($row->view->depend) {

        $result = $row->view->depend;
        $result = explode("=", $result);
        $key = $result[0];
        $value = $result[1];
        $row->view->hasDepend = true;

        $row->role->nullable = true;

        foreach ($temp as $row2) {
          if ($row2->view->fillAble == $key) {
            $row2->view->depender = true;
            $row->view->dependTo = $key;
            $row->view->dependValue = $value;
          }
        }
      }
    }
    return $temp;
  }


  private function getTableColumnAndTypeList($tableName)
  {
    $records = [];
    foreach (DB::select("describe $tableName") as $field) {
      $records[] = $field;
      //      $type = ($fullType || !str_contains($field->Type, '(')) ? $field->Type : substr($field->Type, 0, strpos($field->Type, '('));
      //      $fieldAndTypeList[$field->Field] = $type;
    }
    return $records;
  }


  public function scopeGetOptions(): array
  {
    return $this->options();
  }


  public function scopeSaveButton()
  {
    return $this->saveButton;
  }

  public function scopeSaveAndBackButton()
  {
    return $this->saveAndBackButton;
  }

  public function scopeCancelButton()
  {
    return $this->cancelButton;
  }

  public function renderActions()
  {
    return XActionsBuilder::render($this);
  }

  public function update(array $attributes = [], array $options = [])
  {
    $this->fillable = $this->scopeGetAllFillAbles();
    return parent::update($attributes, $options);
  }

  public function save(array $options = [])
  {
    return parent::save($options);
  }

  public static function getSearchFields(): array
  {
    return self::$searchFields;
  }

  public static function xNavigation()
  {
    return NavigationBuilder::getDefault();
  }


  public static function disable(): XDisable
  {
    return XDisable::getInstance();
  }

  public function getMenuTitle(): ?string
  {
    return $this->title;
  }

  public function getMenuPluralTitle(): ?string
  {
    return $this->pluralTitle;
  }

  public static function getIndexView()
  {
    return self::$indexView;
  }

  public static function searchBuilder(): XSearch
  {
    return XSearch::getInstance();
  }

  public function scopeGetXModelTable()
  {
    return $this->getTable();
  }

  public static function getWithRelations(): array
  {
    return [];
  }

  public function scopeIsActiveSearch(): bool
  {
    return $this->activeSearch;
  }

}
