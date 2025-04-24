<div class="right-sidebar">
  <div class="switcher-icon" style="top: 10px">
    <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
  </div>
  <div class="right-sidebar-content">
    <p class="mb-0">طراحی تم</p>

    <?php
    $data = cache()->get("theme", \App\Panel\UiHandler\Theme\ThemeManagement::getDefaultdata());

    ?>
    <hr>
    <div>
      <label for="">رنگ متن</label>
      <input id="t_text-color" value="{{@$data["color"]}}" type="color" class="form-control">
    </div>

    <div>
      <label for="">رنگ آیکن ها</label>
      <input id="t_accent" value="{{@$data["accent"]}}" type="color" class="form-control">
    </div>

{{--    <div>--}}
{{--      <label for="">پس زمینه دیالگ ها</label>--}}
{{--      <input id="t_dialog-background" value="{{@$data["dialogBackground"]}}" type="color" class="form-control">--}}
{{--    </div>--}}


{{--    <div>--}}
{{--      <label for="">رنگ عناصر دیالگ ها</label>--}}
{{--      <input id="t_dialog-color" value="{{@$data["dialogColor"]}}" type="color" class="form-control">--}}
{{--    </div>--}}

    <div>
      <label for="">رنگ placeholder</label>
      <input id="t_place-holder-color" value="{{@$data["placeHolderColor"]}}" type="color" class="form-control">
    </div>


    <hr>
    <div>
      <label for="">بلر پس زمینه</label>
      <input id="t_backdrop-blur" value="{{@$data["blur"]}}" type="range" class="form-control">
    </div>


    {{--    <ul class="switcher">--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme1" id="theme1"></li>--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme2" id="theme2"></li>--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme3" id="theme3"></li>--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme4" id="theme4"></li>--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme5" id="theme5"></li>--}}
    {{--      <li style="cursor: pointer" data-theme-class="bg-theme6" id="theme6"></li>--}}
    {{--    </ul>--}}


    <hr>
    <button id="t_save" class="btn btn-success">ذخیره تغییرات</button>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // let result = document.getElementById("backdrop-blur")
    // result.addEventListener("change", save)
    // let color = document.getElementById("text-color")
    // color.addEventListener("change", save)

    let button = document.getElementById("t_save")
    button.addEventListener("click",()=>{
      save()
    })
  })

  function save() {
    let result = document.getElementById("t_backdrop-blur")
    let textColor = document.getElementById("t_text-color")
    let accent = document.getElementById("t_accent")
    // let dialogBackground = document.getElementById("t_dialog-background")
    // let dialogColor = document.getElementById("t_dialog-color")
    let placeHolderColor = document.getElementById("t_place-holder-color")


    let blur = result.value
    document.body.style.backdropFilter = "blur(" + blur + "px)"

    window.Livewire.dispatch("theme-changed", [
      {
        blur,
        color: textColor.value,
        accent: accent.value,
        // dialogBackground: dialogBackground.value,
        // dialogColor: dialogColor.value,
        placeHolderColor: placeHolderColor.value,
      }
    ])
  }

</script>
