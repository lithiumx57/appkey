<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif hidden">
  <label for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="hidden"
    style="{{$view->styles}}"
    @if($view->disabled)
    disabled
    @endif
    id="{{$name}}"
    class="form-control {{$view->classes}} @if($view->ltr) ltr @endif"
    name="{{$name}}"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
</div>
