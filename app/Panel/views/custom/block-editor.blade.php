@extends('layouts.main')
@section('content')
  <form action="{{buildRoute("/blockeditors")}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{getXRequest("block")}}">
    <?php
    use App\Models\Block;
    $block = getXRequest("block");
    $result = Block::findOrFail($block);

    foreach ($result->t as $key => $value) {
    if (@$value['type'] == "string") {
    ?>

    <div class="form-group col-md-8">
      <label for="">{{$value['title']}}</label>
      <input name="{{$key}}" type="text" class="form-control" value="{{$value['value']}}">
    </div>
    <?php }else if (@$value['type'] == "bool") { ?>

    <div class="form-group col-md-8">
      <input name="{{$key}}" type="checkbox" @if($value['value']) checked @endif>
      <label for="" style="vertical-align: middle">{{$value['title']}}</label>
    </div>
    <?php }
    }
    ?>
    <div class="form-group col-md-8">
      <input type="submit" value="به روز رسانی" class="btn btn-primary">
    </div>
  </form>

@endsection
