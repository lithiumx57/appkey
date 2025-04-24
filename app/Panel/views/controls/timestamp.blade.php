<div {!! $additionalData !!} class=" @if($view->col) {{$view->col}}  p0 @endif" style=";margin-top: 20px;background: rgba(71,71,71,.3);box-shadow: 0 0 2px 0 #666;padding: 8px;">
    <label class="db" for="date{{$name}}">{{$view->label}}</label>
    <div>
        <div style="display: inline-block;vertical-align: middle;width: 50%">
            <input
                aria-placeholder="{{$view->placeholder}}"
                aria-label="{{$view->label}}"
                type="text"
                id="{{$name}}"
                class="form-control tag-input"
                name="{{$name}}"
                style="width: calc(100% - 112px) !important;background: #333;display: inline-block"
                value="{{$value}}"
                placeholder="{{$view->placeholder}}"
            >
        </div>
        <input type="text" name="time{{$name}}" class="form-control time{{$name}}" style="display: inline-block;width: 48%;vertical-align: middle">
        <input type="hidden" name="{{$name}}">
    </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    try {
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


    $(".time{{$name}}").clockpicker({
      placement: 'bottom',
      align: 'left',
      autoclose: true,
      default: 'now',
      donetext: "Select",
      init: function () {
        console.log("colorpicker initiated");
      },
      beforeShow: function () {
        console.log("before show");
      },
      afterShow: function () {
        console.log("after show");
      },
      beforeHide: function () {
        console.log("before hide");
      },
      afterHide: function () {
        console.log("after hide");
      },
      beforeHourSelect: function () {
        console.log("before hour selected");
      },
      afterHourSelect: function () {
        console.log("after hour selected");
      },
      beforeDone: function () {
        console.log("before done");
      },
      afterDone: function () {
        console.log("after done");
      }
    });


  })
</script>
