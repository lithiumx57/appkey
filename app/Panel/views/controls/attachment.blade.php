<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">

  <style>

    .attachment-cover {
      display: none;
      transition: 150ms;
    }

    .attachment-cover.active {
      backdrop-filter: blur(8px);
    }

    .attachment-cover.show {
      display: block;
    }


    .attachment-done_image {
      margin: auto;
    }

    .attachment-container {
      width: 1380px;
      height: 780px;
      max-width: 90%;
      max-height: 90%;
      box-shadow: 0 0 7px 0 #666;
      overflow-y: auto;
      display: none;
      transition: 150ms;
    }

    .attachment-container.active {
      width: 1400px;
      height: 800px;
    }

    .attachment-container.show {
      display: block;
    }

    .attachment-row {
      box-shadow: 0 0 1px 0 #333;


    }

    .attachment-row img {
      width: auto !important;
      height: auto !important;
      max-width: 96%;
      max-height: 96%;
      margin: auto;
      display: block;
      position: absolute;
      left: 0;
      right: 0;
      border-radius: 12px;

    }
  </style>


  <?php
  $value = null;
  $attachment = null;
  ?>
  @if(isEditMode())
      <?php
      $fillable = $object->name;


      if ($object->view->default) {
        $value = $object->view->default;
      } else {
        $value = $record->$fillable;
      }

      if (is_numeric($value)) {
        $attachment = \App\Panel\Models\Attachment::find($value);
      }
      ?>

  @else

      <?php

      if ($object->view->default) {
        $value = $object->view->default;
      }

      if (is_numeric($value)) {
        $attachment = \App\Panel\Models\Attachment::find($value);
      }

      ?>

  @endif


  <div style="background: rgba(71,71,71,.3);margin-top: 16px;padding: 16px">
    <label for="{{$name}}">{{$view->label}}</label>
    <input type="hidden" name="{{$name}}" id="attachment_{{$name}}"
           @if(isEditMode())value="{{@$attachment->id}}" @endif >
    <div class="tac">

      <div id="info{{$name}}" data-size="{{json_encode($object->preSave->imageSizes)}}"></div>
      <div class="attachment-done_{{$name}}" style="width: 100%">

        @if($attachment instanceof \App\Panel\Models\Attachment)
          <div class="">
            <div class="attachment-row" style="backdrop-filter: blur(8px);background: #222;;max-width: 100%;height: auto;margin-top:16px;width: 400px;margin: auto;text-align: center">
              @if($attachment->getType()=="video")
                <video style="max-width: 100%" controls>
                  <source src="{{$attachment->getLink()}}" type="video/mp4">
                </video>
              @elseif($attachment->getType()=="image")
                <img src="{{$attachment->getLink()}}" alt=""
                     style="max-width: 100%;left: 0;right: 0;top: 0;bottom: 0;margin: auto auto;width: auto;height: auto">
              @endif
            </div>
          </div>
        @endif

      </div>

      <div style="margin-top: 32px">
        <span class="btn btn-success btn-sm" onclick="openAttachmentDialog{{$name}}('{{$name}}')">انتخاب پیوست</span>
        <span
          class="btn btn-danger btn-sm delete_attachment @if($attachment instanceof \App\Panel\Models\Attachment) active @endif  delete_attachment_{{$name}}"
          onclick="deleteAttachment{{$name}}('{{$name}}')">حذف پیوست</span>
      </div>

    </div>
  </div>

</div>
<div class="clearfix"></div>


<div>


  <div class="attachment-cover attachment-cover{{$name}}" style="overflow-y: auto">
    <div class="attachment-container attachment-container{{$name}}">
      <div class="attachment-header">
        <span>
          افزودن پیوست
        </span>
        <i class="fa fa-times" onclick="closeDialog{{$name}}()"> </i>
      </div>


      <div id="a-content{{$name}}">
        <div class="upload-new">
          <form action="{{buildRoute("attachment-upload")}}" method="POST"
                enctype="multipart/form-data" id="form_{{$name}}">
            @csrf
            <div class="form-group">
              <div class="needsclick dropzone" style=";color: #222;width: calc(100% - 32px);margin: auto" id="document-dropzone{{$name}}">
              </div>
            </div>
          </form>
        </div>

        <div id="xxx_pagination" style="color: #222;text-align: center" dir="rtl">

        </div>

        <div class="attachment-body attachment-body{{$name}} row" style="height: auto;max-height:none;position: relative;top: 16px">


        </div>
      </div>

    </div>
  </div>


</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    try {
      var uploadedDocumentMap{{$name}} = {}

      Dropzone.options["documentDropzone{{$name}}"] = {
        url: '{{buildRoute("attachment-upload")}}',

        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
          "upload-path": '{{$object->preSave->uploadPath}}',
          "model": "{{str_replace("\\","/",$model)}}",
          "sizes": document.getElementById("info{{$name}}").getAttribute("data-size"),
          "extensions": '{!! json_encode($object->preSave->extensions) !!}',
        },
        success: function (file, response) {
          $('#form_{{$name}}').append('<input type="hidden" name="document[]" value="' + response.name + '">')
          uploadedDocumentMap{{$name}}[file.name] = response.name
          openAttachmentDialog{{$name}}('{{$name}}')
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedDocumentMap{{$name}}[file.name]
          }
          $('#form_{{$name}}').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function () {
          @if(isset($project) && $project->document)
          var files = '{!! json_encode($project->document) !!}'

          for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('#form_{{$name}}').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
          }
          @endif
        }
      }
    } catch (e) {

    }
  })
</script>
<script>

  function openAttachmentDialog{{$name}}(name) {
    $("#a-content{{$name}}").css("display", "none")

    $(".attachment-cover{{$name}}").addClass("show")
    setTimeout(function () {
      $(".attachment-cover{{$name}}").addClass("active")

      $(".attachment-container{{$name}}").addClass("show")
      setTimeout(function () {
        $(".attachment-container{{$name}}").addClass("active")

        setTimeout(function () {
          $("#a-content{{$name}}").css("display", "block")
        }, 100)

      }, 20)
    }, 20)


    getDataFromServer{{$name}}(name)
  }


  let xAttachmentClicked{{$name}} = false;
  document.addEventListener("click", (event) => {
    if (xAttachmentClicked{{$name}}) {
      return
    }
    xAttachmentClicked{{$name}} = true
    if (event.target.className === "fa fa-trash attachment_row_delete") {
      event.preventDefault()
      event.stopPropagation()

      let id = event.target.getAttribute("data-id")
      console.log(id)
    }
  })

  function closeDialog{{$name}}() {
    // $(".attachment-cover").removeClass("active")

    $("#a-content{{$name}}").css("display", "none")


    $(".attachment-container{{$name}}").removeClass("active")
    setTimeout(function () {
      $(".attachment-container{{$name}}").removeClass("show")
    }, 150)

    $(".attachment-cover{{$name}}").removeClass("active")
    setTimeout(function () {
      $(".attachment-cover{{$name}}").removeClass("show")
    }, 180)


  }

  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("attachment-cover")) {
      closeDialog{{$name}}()
    }
  })


  function getDataFromServer{{$name}}(name, page = 1) {
    $.ajax({
      url: '{{buildRoute("attachments-dialog")}}',
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        page
      }
    }).done(response => {
      initReceivedData{{$name}}(response)
    })
  }


  function initReceivedData{{$name}}(response) {
    $(".attachment-body").html("")
    let container = $('.attachment-body')

    response.records.map(row => {
      addAttachmentRow{{$name}}(container, row, name)
    })

    let paginationContainer = document.getElementById("xxx_pagination")

    paginationContainer.innerText = ""

    if (!paginationContainer) {
      return;
    }


    if (response.lastPage === 1) {
      return;
    }

    for (let i = 1; i <= response.lastPage; i++) {

      if (response.currentPage - 3 > i) {
        continue
      }

      if (response.currentPage + 3 < i) {
        continue
      }

      let span = document.createElement("span")
      if (response.currentPage == i) {
        span.classList.add("active")
      }
      span.classList.add("pagination-item")
      span.addEventListener("click", function () {
        getDataFromServer{{$name}}(name, i)
      })
      span.innerText = i + ""
      paginationContainer.appendChild(span)

    }
  }


  function deleteAttachment{{$name}}(name) {
    let result = document.getElementById("attachment_" + name)
    result.value = ""
    $(".attachment-done_" + name).empty()
    $(".delete_attachment_" + name).removeClass("active")
  }


  function deleteRow{{$name}}(row) {
    let result = confirm("فایل حذف شود؟")
    if (result) {
      $.ajax({
        url: '{{buildRoute("attachments-dialog/delete")}}',
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          id: row.id
        }
      }).done(response => {
        initReceivedData{{$name}}(response)

      })
    }

  }

  function addAttachmentRow{{$name}}(container, row, name) {
    name = '{{$name}}'
    let _row = JSON.stringify(row).replaceAll("\"", "\'")


    container.append(`<div class="col-md-3 col-lg-2 p-1" style="position: relative">
       ${row.type === "image" ? `<i style="position: absolute;left: 16px;top: 16px" class="fa fa-image"></i>` : ""}
            ${row.type === "image" ? `<i onclick="deleteRow{{$name}}(${_row})" data-id="${row.id}"  class="fa fa-trash attachment_row_delete" style="cursor: pointer;z-index: 99;;color: #ff4444;position: absolute;left: 44px;top: 14px;font-size: 16px"></i>` : ""}
            ${row.type === "video" ? `<i class="fa fa-video-camera"></i>` : ""}
            ${row.type === "audio" ? `<i class="fa fa-file-audio-o"></i>` : ""}
          <div class="attachment-row" onclick="attachnentChoosed{{$name}}(${_row},'${name}')">

            ${row.type === "image" ? `<div style="position: absolute;bottom:8px;left: 8px;z-index: 9;padding: 0 8px;display:inline-block;background: #fff;border-radius: 8px">${row.sizes.join("-")}</div>` : ""}
             ${row.type === "image" ? `<div style="position: absolute;bottom:40px;left: 8px;z-index: 9;padding: 0 8px;display:inline-block;background: #fff;border-radius: 8px">${row.extensions.join("-")}</div>` : ""}
            ${row.type === "image" ? `<img  src="${row.link}" alt="" style="position: absolute;left: 0;right: 0;;;;max-width: 98%;max-width: 98%;width: auto;height: auto;margin-bottom: auto;display: block;border-radius: 8px">` : ""}
            ${row.type === "video" ? `<video controlsList="nodownload" controls src="${row.link}" alt="" style="width: 98%;"></video>` : ""}
            ${row.type === "audio" ? `<audio  controlsList="nodownload" controls src="${row.link}" alt="" style="width: 80%;margin: 80px auto"></audio>` : ""}
          </div>
        </div>`)
  }


  function attachnentChoosed{{$name}}(row, name) {


    const showSwal = (message) => {
      alert(message)
    }


    const areArraysEqual = (arr1, arr2) => {
      if (arr1.length !== arr2.length) return false;
      return arr1.every(item => arr2.includes(item)) && arr2.every(item => arr1.includes(item));
    }


    let validSizes = JSON.parse('{!! json_encode($object->preSave->imageSizes) !!}')
    let validExtensions = JSON.parse('{!! json_encode($object->preSave->extensions) !!}')

    let equalsSizes = areArraysEqual(validSizes, row.sizes)
    let equalsExtensions = areArraysEqual(validExtensions, row.extensions)

    if (!equalsSizes || !equalsExtensions) {
      showSwal("تصاویر انتخابی مناسب این مدل نیست")
      return;
    }



    let result = document.getElementById("attachment_" + '{{$name}}')
    result.value = row.id

    $(".delete_attachment_" + name).addClass("active")


    $(".attachment-done_" + name).html(
      `<div class="col-12">
          <div class="attachment-row" style="width: 400px;margin: auto;min-height: 200px;max-width: 100%">
            ${row.type === "image" ? `<i class="fa fa-image"></i>` : ""}
            ${row.type === "video" ? `<i class="fa fa-video-camera"></i>` : ""}
            ${row.type === "audio" ? `<i class="fa fa-file-audio-o"></i>` : ""}
            ${row.type === "image" ? `<img  src="${row.link}" alt="" style="width: 98%;height: auto">` : ""}
            ${row.type === "video" ? `<video controlsList="nodownload" controls src="${row.link}" alt="" style="width: 98%;"></video>` : ""}
            ${row.type === "audio" ? `<audio  controlsList="nodownload" controls src="${row.link}" alt="" style="width: 80%;margin: 80px auto"></audio>` : ""}
          </div>
        </div>`
    )
    closeDialog{{$name}}()
  }


</script>
