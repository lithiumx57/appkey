<div     class="row">
  @foreach($elements as $field)
    <div class="col-md-{{12/count($elements)}}">
      {!! $field->render($record) !!}
    </div>
  @endforeach
</div>
