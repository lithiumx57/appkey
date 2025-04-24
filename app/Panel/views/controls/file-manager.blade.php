<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif file-manager-container">
    <label for="{{$name}}" style="display: block;border-bottom: 1px solid #666;padding-bottom: 4px">
        <i data-default-path="{{public_path($view->fileManagerPath)}}" class="fa fa-long-arrow-right" id="{{$name}}back" style="font-size: 16px;cursor: pointer"></i>
        <span style="float: left">{{$view->label}}</span>
    </label>
    <input type="hidden" name="{{$name}}" id="{{$name}}">
    <div id="{{$name}}file-manager-container">
        @foreach (\App\Panel\helpers\XFile::with(public_path($view->fileManagerPath))->fileList() as $row)
            <div class="file-row" data-path="{{$row->getPath()}}" data-is-file="{{$row->isFile()}}">
                @if ($row->isFile())
                    @if ($row->isImage())
                        <i class="fa fa-image"></i>
                        {{$row->getName()}}
                    @elseif ($row->isVideo())
                        <i class="fa fa-file-video-o"></i>
                        {{$row->getName()}}
                    @elseif ($row->isAudio())
                        <i class="fa fa-file-audio-o"></i>
                        {{$row->getName()}}
                    @else
                        <i class="fa fa-file"></i>
                        {{$row->getName()}}
                    @endif
                @else
                    <i class="fa fa-folder"></i>
                    {{$row->getName()}}
                @endif
            </div>
        @endforeach
    </div>

</div>

<script>
  let path = null;

  document.addEventListener("DOMContentLoaded", () => {
    let defaultPath = $("{{$name}}back").data('categories-path')

    let fileRow = $('.file-row')
    fileRow.click(function () {
      $(".file-row").removeClass('active')
      $(this).addClass('active')
    })

    fileRow.dblclick(function () {
      $(".file-row").removeClass('active')
      $(this).addClass('active')
      path = $(this).data('path');
      $("#{{$name}}").empty().append(path)

      let isFile = $(this).data('is-file') === 1
      if (!isFile) {
        renderFiles('{{buildRoute("file-manager/render-path?path=")}}' + path)
      }

    })


    $("#{{$name}}back").unbind()

    $("#{{$name}}back").click(function () {
      if (path == null || path === defaultPath) {
        return;
      }
      let basePath = "{{buildRoute("/file-manager/render-path?path=")}}"
      let oldPath = path.split('/');
      oldPath.pop()
      let newPath = oldPath.join("/")

      renderFiles(basePath + newPath)
    })

  })

  function renderFiles(url) {
    $.ajax({
      url,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
    }).done(function (data) {
      let container = $("#{{$name}}file-manager-container")
      container.empty()

      data.map(row => {
        let fileRow = '<div class="file-row" data-path="' + row.path + '" data-is-file="' + row.isFile + '">';

        if (row.isFile) {
          if (row.isImage) {

            fileRow += "<i class='fa fa-image'></i>"
          } else if (row.isVideo) {
            fileRow += "<i class='fa fa-file-video-o'></i>"
          } else if (row.isAudio) {
            fileRow += "<i class='fa fa-file-audio-o'></i>"
          } else {
            fileRow += "<i class='fa fa-file'></i>"
          }

        } else {
          fileRow += "<i class='fa fa-folder'></i>"
        }
        fileRow += " " + row.name
        fileRow += "</div>";
        container.append(fileRow)
      })


      var DOMContentLoaded_event = document.createEvent("Event")
      DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)
      window.document.dispatchEvent(DOMContentLoaded_event)

    })
  }

</script>
