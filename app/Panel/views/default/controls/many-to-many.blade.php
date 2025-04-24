<?php
$fillAble = $field->view->fillAble;
$renderField = $field->view->renderField;
$relations = $record->$name;
$rows = \App\Panel\Singleton\ManyToMany::getData($fillAble, $field->relation->targetRelationClass);

?>

<span
  class="btn btn-primary show-dialog"
  data-fillable="{{$fillAble}}"
  data-record-id="{{$record->id}}"
> مشاهده و تغییر </span>

<div class="x-dialog dialog-cover">
  <div class="dialog" id="dialog_{{$fillAble}}_{{$record->id}}">
    <div class="header">
      <i class="zmdi zmdi-close close"></i>
      <span class="title">{{$field->view->label}}</span>
    </div>
    <div class="body" style="text-align: right">
      @foreach($rows as $row)
        <div class="mtm-row">
          <div class="icheck-material-success">
            <input data-id="{{$row->id}}" @foreach($relations as $r) @if($r->id==$row->id) checked @endif @endforeach
            type="checkbox" id="mtm{{$record->id}}_{{$row->id}}" value="{{$row->id}}" class="select-checkbox mtm_{{$record->id}}">
            <label style="font-weight: bold" class="f12" for="mtm{{$record->id}}_{{$row->id}}" id="label_{{$row->id}}">
              <?php $i = 0; ?>
              @foreach($renderField as $rf)
                <?php $i++; ?>
                {{$row->getAttribute($rf)}}
                @if(count($renderField)> $i)
                  -
                @endif
              @endforeach

            </label>
          </div>
        </div>
      @endforeach
    </div>
    <div class="footer">
      <span class="btn btn-success confirm-dialog"
            data-route="{{$route}}"
            data-fillable="{{$name}}" data-id="{{$record->id}}">به روز رسانی</span>
    </div>

  </div>
</div>

