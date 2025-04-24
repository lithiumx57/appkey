<?php
$unique = rand(0, 999999);
?>
<div {!! $additionalData !!} class="form-group {{$view->responsive }}" style="margin-right: 5px">

  <input type="hidden"
         name="{{$name}}"
         value="0"
  >

  <div class="icheck-material-success p_parent {{$view->parentClass}} @if(!strpos(" ".$view->parentClass,"col-")) li-form @endif">

    <input
      @if(old($name,$view->default)) checked @endif
    type="checkbox"
      id="{{$name.$unique}}"
      name="{{$name}}"
      class="{{$view->classes}}"
      value="1"
      @if($object->isEditMode())
      @if($record->$name)
      checked
      @endif
      @elseif($view->default)
      checked
      @endif
    >
    <label class="f15" for="{{$name.$unique}}">{{$view->label}}</label>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    $("#{{$name.$unique}}").on("click", function (event) {
      initBool($(this))
    })

    function initBool(tag) {
      if (tag.is(":checked")) {
        tag.val(1)
      } else {
        tag.val(0)
      }
    }

    initBool($("#{{$name.$unique}}"))

  })
</script>
