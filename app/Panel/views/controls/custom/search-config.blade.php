<div>

  <?php
  $result = \App\Panel\Models\PanelModel::getSearchRow();


  function hasSearchConfig($result, $model, $row)
  {
    $modelData = @$result->data[$model];
    if ($modelData == null) return false;
    foreach ($modelData as $field){
      if ($field==$row){
        return true;
      }
    }
    return false;
  }
  ?>

  @foreach(\App\Panel\helpers\ModelHelper::getModels() as $model)
    @if(hasArrayIndex(\App\Panel\Models\PanelModel::ESCAPES,$model["class_path"]))
      @continue
    @endif
    <div>
      @if(is_string($model['class_path']::getXTitle()))
        {{$model['class_path']::getXTitle()}}
      @endif

      @foreach($model['class_path']::getAllFillAbles() as $row)
        @if(\App\Panel\helpers\XStringHelper::hasString($row,"_id"))
          @continue
        @endif

        @if($row=="id")
          @continue
        @endif

        @if($row=="created_at")
          @continue
        @endif

        @if($row=="updated_at")
          @continue
        @endif


        <div style="padding-right: 10px" class="p_child">
          <div class="icheck-material-warning">
            <input @if(hasSearchConfig($result,$model["class_path"],$row)) checked @endif type="checkbox"
                   id="success_{{$model["class_path"]}}{{$row}}"
                   name="search[{{$model["class_path"]}}][{{$row}}]" value="true" class="permission">
            <label style="font-weight: bold" class="f12"
                   for="success_{{$model["class_path"]}}{{$row}}">{{$row}}</label>
          </div>
        </div>

      @endforeach
    </div>
    <hr>
  @endforeach
</div>
