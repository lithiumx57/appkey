<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <input type="hidden" name="{{$name}}" id="mc_input_{{$name}}"
         @if(isEditMode()) value="{{@$object->getAttachmentId()}}" @endif >
  <div class="card media-container">
    <div class="media-display" id="media-display">

      @if(isEditMode())
        @if(\App\Panel\UiHandler\Elements\XMediaChooser::isVideo($object->getLink()))
          <video id="image_{{$name}}" controls src="{{$object->getLink()}}"></video>
        @elseif(\App\Panel\UiHandler\Elements\XMediaChooser::isImage($object->getLink()))
          <img id="image_{{$name}}" src="{{$object->getLink()}}" alt="">
        @endif
      @else
        <img id="image_{{$name}}" src="" alt="">
      @endif

    </div>
    <div class="buttons">
      <span class="btn btn-success btn-sm select-mc" id="mc-choose-{{$name}}">انتخاب</span>
      &nbsp; &nbsp;
      <span id="mc-remove-{{$name}}" class="btn btn-danger btn-sm select-mc">حذف</span>
    </div>
  </div>
</div>


<script>
  let button = document.getElementById("mc-choose-{{$name}}")
  button.addEventListener("click", () => {
    document.body.style.overflow = "hidden"
    runMediaChooser('{{$view->label}}', '{{$name}}', '{{buildRoute("/media-dialog/delete")}}', '{{buildRoute("media-upload")}}', '{{buildRoute("media-dialog")}}')
    let dialogCover = document.getElementById("mc-dialog-cover-{{$name}}")
    let dialog = document.getElementById("mc-dialog-{{$name}}")
    dialogCover.classList.add('show')
    dialog.classList.add("show")

    setTimeout(function () {
      dialogCover.classList.add('active')
      dialog.classList.add('active')
    }, 20)
  })

</script>
