<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="{{$view->dynamicType}}"
    style="{{$view->styles}}"
    @if($view->disabled)
    disabled
    @endif
    id="{{$name}}"
    class="form-control {{$view->classes}} @if($view->ltr) ltr @endif @if($view->center) tac @endif"
    name="{{$name}}"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
</div>
