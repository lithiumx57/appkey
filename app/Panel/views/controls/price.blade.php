<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="text"
    style="{{$view->styles}}"
    id="{{$name}}"
    class="form-control  {{$view->classes}} ltr"
    name="{{$name}}"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
</div>
<script src="{{asset('dashboard/js/cleave.min.js')}}"></script>
<script>
  document.addEventListener("DOMContentLoaded",function () {
    new Cleave("#{{$name}}", {
      numeral: true,
      numeralThousandsGroupStyle: 'thousand'
    });
  })
</script>
