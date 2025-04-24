<?php
$fillAble = $field->view->fillAble;
$mimes = $field->view->mimes;
$uplodedName = $record->$name;
$extension = null;
if ($uplodedName) {
  $extension = \App\Panel\helpers\XFileHelper::getExtension($uplodedName);
}
$type = null;
$filePath = $uplodedName;
?>

@if($extension != null)
  @foreach($mimes as $key=> $mime)
    @foreach($mime as $row)
      @if($row==$extension)
          <?php $type = $key; ?>
        @break
      @endif
    @endforeach
  @endforeach
@endif


@if($type=="video")
  <video src="{{$filePath}}" preload="none" controls style="width: 300px"></video>
@elseif($type=="audio")
  <audio src="{{$filePath}}" preload="none" controls style="width: 300px"></audio>
@elseif($type=="pdf")
  <iframe src="{{$filePath}}" style="width: 300px"></iframe>
@elseif($type=="image")
  <a href="{{$filePath}}"><img src="{{$filePath}}" style="width: 160px" alt=""></a>
@endif