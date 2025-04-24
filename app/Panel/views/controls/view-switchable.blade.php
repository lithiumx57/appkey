<?php
$id = $name . rand(0, 999999);
?>
<select name="{{$name}}" id="{{$id}}" class="form-control {{$view->classes}}">
    @foreach($values as $key => $value)
        <option value="{{$key}}" @if($record->$name == $key) selected @endif >
            {{$value}}
        </option>
    @endforeach
</select>


<script>

  document.addEventListener("DOMContentLoaded", () => {
    $('#{{$id}} option').click(function () {
      let val = $(this).val();
      let name = "{{$name}}"
      $.ajax({
        method: "GET",
        url: "{{buildRoute(\App\Panel\helpers\ModelHelper::getResourseRoute(\App\Panel\Controllers\AdminController::$model))}}/{{$record->id}}?type=switchable-field&name=" + name +
          "&value=" + val
      }).done(function (data) {
        if (data.status) {
          swal({
            title: data.message,
            type: 'success',
          }).then((result) => {
          });
        }
      })
    })
  })
</script>
