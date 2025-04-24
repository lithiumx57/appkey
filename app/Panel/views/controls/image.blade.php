<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <?php
  $path = $view->default;
  if ($object->isEditMode()) {
    $path = $object->getPath();
    if (is_array($path)) {
      $path = getXFirstIndex($path);
    }
  }
  ?>

  @if($object->isEditMode())
    <div id="image-helper{{$name}}" data-path="{{json_encode($object->getPath())}}"></div>
  @endif

  <div class="image-field">
    <div class="tac mt-2">{{$view->label}}</div>
    <div class="tac mt-4">
      <span class="btn btn-info upload-button select-image" data-name="{{$name}}" id="selectImage{{$name}}">انتخاب تصویر</span>
      @if($object->isEditMode())
        @if($path && file_exists(public_path($path)))
          <span class="btn btn-danger upload-button remove-image" data-name="{{$name}}" id="deleteImage{{$name}}" data-path="{{$path}}">حذف این تصویر</span>
        @endif
      @endif
    </div>
    <input type="file" id="file{{$name}}" name="{{$name}}" class="hidden" accept="image/*">
    <input type="hidden" name="must-make-null{{$name}}" id="must-make-null{{$name}}" @if($path && file_exists(public_path($path))) value="false" @else value="true" @endif>
    <div class="tac mt-4">
      <a href="{{$path}}">
        <img src="{{$path}}" alt="" id="image{{$name}}" style="width: 250px;border-radius: 4px;"></a>
      <div id="text{{$name}}Container" class="image-name-container">
        <span class="key">نام فایل: </span> <span class="value" id="text{{$name}}"></span>
      </div>
    </div>
  </div>

</div>


