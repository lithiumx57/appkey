@extends("layouts.main")

@section("style")
  <link rel="stylesheet" href="{{asset("dashboard/css/dropzone.css")}}">

@endsection

@section("content")
  <div class="card card-primary">
    <div class="card-header">پیوست ها</div>
    <div class="card-body">
      <form id="id_dropzone"
            class="dropzone"
            action="{{buildRoute("attachment-upload")}}"
            enctype="multipart/form-data"
            method="post">
      </form>

      <div class="attachment-body row" style="max-height: none">

      </div>

      <div id="xxx_pagination">

      </div>
    </div>

  </div>

@endsection

@section("script")
  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js "></script>

  <script>

    let _page = 1;

    getDataFromServer()

    function getDataFromServer(page = 1) {
      _page = page

      $.ajax({
        url: '{{buildRoute("attachments-dialog")}}',
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          page,
          count: 16
        }
      }).done(response => {
        fetchResponse(response)
      })
    }

    function fetchResponse(response) {

      $(".attachment-body").html("")
      let container = $('.attachment-body')

      response.records.map(row => {
        addAttachmentRow(container, row)
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
        if (response.currentPage - 3 > i) continue
        if (response.currentPage + 3 < i) continue

        let span = document.createElement("span")
        if (response.currentPage == i) {
          span.classList.add("active")
        }
        span.classList.add("pagination-item")
        span.addEventListener("click", function () {
          getDataFromServer(i)
        })
        span.innerText = i + ""
        paginationContainer.style.textAlign = "center"
        paginationContainer.appendChild(span)

      }
    }

    function deleteAttachment(name) {
      let result = document.getElementById("attachment_" + name)
      result.value = ""
      $(".attachment-done_" + name).empty()
      $(".delete_attachment_" + name).removeClass("active")
    }

    function confirmMessage(message, callback) {
      Swal.fire({
        title: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'خیر',
        confirmButtonText: 'بله حذف شود'
      }).then((result) => {
        if (result.value) {
          callback()
        }
      })
    }

    function addAttachmentRow(container, row, name) {
      let _row = JSON.stringify(row).replaceAll("\"", "\'")


      container.append(`<div class="col-md-3 col-lg-2 p-1">
    <div class="attachment-row" style="box-shadow: 0 0 7px 0 #222;position: relative">
      <i class="fa fa-trash" style="position: absolute;right: 8px;color: #fff"
      onclick="removeAttachment(${row.id})"></i>

      ${row.type === "image" ? `<i class="fa fa-image"></i>` : ""}
      ${row.type === "video" ? `<i class="fa fa-video-camera"></i>` : ""}
      ${row.type === "audio" ? `<i class="fa fa-file-audio-o"></i>` : ""}
      ${row.type === "image" ? `<img  src="${row.link}" alt="" style="width:400px;max-width: 98%;">` : ""}
      ${row.type === "video" ? `<video controlsList="nodownload" controls src="${row.link}" alt="" style="max-width: 98%;"></video>` : ""}
      ${row.type === "audio" ? `<audio  controlsList="nodownload" controls src="${row.link}" alt="" style="width: 80%;margin: 80px auto"></audio>` : ""}
    </div>
  </div>`)
    }

    function removeAttachment(row) {
      confirmMessage("پیوست حذف شود؟",function (){
        $.ajax({
          url: '{{buildRoute("attachments-dialog/delete")}}',
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },

          data: {
            id: row,
            page: _page,
            count:16
          }
        }).done(function (data) {
          fetchResponse(data)
        })
      })

    }


    function attachnentChoosed(row, name) {
      let result = document.getElementById("attachment_" + name)
      result.value = row.id

      $(".delete_attachment_" + name).addClass("active")

      $(".attachment-cover").removeClass("active")
      $(".attachment-done_" + name).html(
        `<div class="col-12">
    <div class="attachment-row" style="width: 400px;max-width: 100%;margin-top:16px;min-height: 200px">
      ${row.type === "image" ? `<i class="fa fa-image"></i>` : ""}
      ${row.type === "video" ? `<i class="fa fa-video-camera"></i>` : ""}
      ${row.type === "audio" ? `<i class="fa fa-file-audio-o"></i>` : ""}
      ${row.type === "image" ? `<img  src="${row.link}"  alt="" style="width:400px;max-width: 98%;">` : ""}
      ${row.type === "video" ? `<video controlsList="nodownload" controls src="${row.link}" alt="" style="width:400px;max-width: 98%;"></video>` : ""}
      ${row.type === "audio" ? `<audio  controlsList="nodownload" controls src="${row.link}" alt="" style="width:400px;max-width: 80%;margin: 80px auto"></audio>` : ""}
    </div>
  </div>`
      )
    }


  </script>





  <script>
    Dropzone.autoDiscover = false;
    var uploadedDocumentMap = {}
    $(document).ready(function () {
      $("#id_dropzone").dropzone({
        maxFiles: 2000,
        url: "{{buildRoute("attachment-upload")}}",
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
          "upload-path": '{{null}}',
        },
        success: function (file, response) {
          $('#id_dropzone').append('<input type="hidden" name="document[]" value="' + response.name + '">')
          uploadedDocumentMap[file.name] = response.name
          getDataFromServer()
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedDocumentMap[file.name]
          }
          $('#id_dropzone').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function () {
          @if(isset($project) && $project->document)
          var files = '{!! json_encode($project->document) !!}'

          for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('#id_dropzone').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
          }
          @endif
        }
      });
    })
  </script>

@endsection
