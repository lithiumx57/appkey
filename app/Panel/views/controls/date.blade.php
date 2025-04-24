<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif" style=";margin-top: 20px">
  <label class="db" for="{{$name}}">{{$view->label}}</label>
  <input
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="text"
    id="{{$name}}"
    class="form-control tag-input {{$view->classes}}"
    name="{{$name}}"
    style="width: calc(100% - 112px) !important;background: #333"
    value="{{$value}}"
    placeholder="{{$view->placeholder}}"
  >
</div>
<script>
  let isCreated{{$name}} = false;
  document.addEventListener("DOMContentLoaded", function () {
    try {

      if(isCreated{{$name}}){
        return;
      }
      isCreated{{$name}}=true;

      new AMIB.persianCalendar("{{$name}}", {
        extraInputID: "extra",
        extraInputFormat: "YYYYMMDD",
      });

      setTimeout(function () {
        var tag = $(".pcalBtn")
        tag.text("باز کردن تقویم")
        tag.addClass("btn")
        tag.addClass("btn-success")
      }, 1)
    } catch (e) {
    }
  })
</script>
