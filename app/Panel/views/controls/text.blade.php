<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <textarea
    aria-placeholder="{{$view->placeholder}}"
    aria-label="{{$view->label}}"
    type="text"
    style="{{$view->styles}}"
    @if($view->disabled)
      disabled
    @endif
    data-must-smart=""
    id="{{$name}}"
    class="form-control {{$view->classes}} @if($view->ltr) ltr @endif"
    name="{{$name}}"
    placeholder="{{$view->placeholder}}"
  >{{$value}}</textarea>
</div>

<script>
  @if(isEditMode() || isCreateMode() ||true)
  document.addEventListener("DOMContentLoaded", function () {
    @if($view->smartEditor)
      try {
      setupEditor("{{$name}}")
    } catch (e) {
    }

    @endif
  })

  function setupEditor(id, locale = "fa") {
    CKEDITOR.config.language = locale;
    CKEDITOR.config.filebrowserUploadUrl = "{{$object->getImageUploadPath()}}";
    CKEDITOR.config.extraPlugins = ['uploadimage', 'html5video', 'html5audio','btgrid',"addclass","customTag"];

    CKEDITOR.config.uploadUrl = "{{$object->getImageUploadPath()}}";
    CKEDITOR.replace(id)

  }
  @endif
</script>
