@foreach($separationsRecords as $record)
  @if($record->action instanceof \App\Panel\Actions\XActionSelect)
    <?php
    $field = $record->action->getAttribute("field");
    ?>
    <td class="action-td">
      <select class="x-action-select selectpicker" data-record-id="{{$record->id}}" {!! $record->action->buildAttributeFromArray($record->attributes) !!}>

        @foreach($record->action->options as $key=>$value)
          <option @if($model->$field==$key) selected @endif value="{{$key}}">{{$value}}</option>
        @endforeach
      </select>
    </td>
  @else
    <td class="action-td">
      <a {!! $record->action->buildAttributeFromArray($record->attributes) !!} class="x-action" data-record-id="{{$record->id}}">
        @if($record->isButtonMode)
          <span class="{{$record->classes}}">{{$record->title}}</span>
        @else
          <i data-toggle="tooltip" title="{{$record->title}}" class="{{$record->classes}}"></i>
        @endif
      </a>
    </td>
  @endif
@endforeach
@if($records->count() > 0)
  <td class="action-td">
    @foreach($records as $record)
      <a {!! $record->action->buildAttributeFromArray($record->attributes) !!} class="x-action" data-record-id="{{$record->id}}">
        @if($record->isButtonMode)
          <span class="{{$record->classes}}">{{$record->title}}</span>
        @else
          <i data-toggle="tooltip" title="{{$record->title}}" data-original-title="asdsd" class="{{$record->classes}}"></i>
        @endif
      </a>
    @endforeach
  </td>
@endif
