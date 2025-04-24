<div {!! $additionalData !!} class="{{$view->responsive}} @if(!strpos(" ".$view->parentClass,"col-")) li-form @endif {{$view->parentClass}} ">
  <label for="{{$name}}">{{$view->label}}</label>


  <select @if($view->multiple) name="{{$name."[]"}}" @else name="{{$name}}" @endif id="{{$name}}" class="form-control {{$view->classes}} {{$name."select2"}}
  @if($view->smartSelect)  @endif" @if($view->smartSelect) data-live-search="true" @endif @if($view->multiple) multiple @endif>


    @foreach($view->selectOptions as $key => $value)
      <option @if($key==$view->default) selected @endif  value="{{$key}}" @if($object->isEditMode()) @if($record->$name == $key) selected @endif @else  @if(old($name)) @if(old($name)== $key)  selected @endif @elseif($view->default==$key) selected @endif @endif >
        {{$value}}
      </option>
    @endforeach
  </select>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    $("#{{$name}}").select2()


    window.onresize = function () {
      $(".select2-container").css("width", "100%")
    }

  })
</script>
