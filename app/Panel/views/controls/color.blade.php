<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="text"
    @if($view->disabled)
    disabled
    @endif
    style="{{$view->styles}}"
    id="{{$name}}"
    class="form-control color {{$view->classes}} @if($view->ltr) ltr @endif jscolor"
    name="{{$name}}"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
</div>
<script src="{{asset('dashboard/js/jscolor.js')}}"></script>


