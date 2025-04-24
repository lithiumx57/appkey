<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif uploader" style="margin-top: 20px">
    <label for="mimes{{$name}}">{{$view->label}}</label>
  <?php
  use App\Panel\Exceptions\XPanelException;
  $isMultiple = $view->isMultipleTypes;
  $mimes = $view->mimes;

  $type = null;
  $filePath = null;
  $fileName = null;
  $baseUploadPath = "/" . getConfigurator()->getUploadPrefix();;

  foreach ($mimes as $key => $mime) {
    $type = $key;
    break;
  }

  if ($type == null) {
    throw  new XPanelException("['video' => ['mp4','avi'] , ...] : فیلد آپلودر باید حد اقل دارای یک نوع دیتا باشد مثال   ");
  }


  $extension = null;
  if ($object->isEditMode()) {
    $field = $object;
    $fillAble = $field->view->fillAble;
    $mimes = $field->view->mimes;
    $fileName = $record->$name;


    $filePath = "/" . getConfigurator()->getUploadPrefix() . "/" . $fileName;
    $extension = \App\Panel\helpers\XFileHelper::getExtension($fileName);
  } else if (old($name)) {
    $fileName = $name;
    $filePath = "/" . getConfigurator()->getUploadPrefix() . "/" . $fileName;
    $extension = \App\Panel\helpers\XFileHelper::getExtension($fileName);
  }


  if ($extension) {
    foreach ($mimes as $key => $mime) {
      foreach ($mime as $m) {
        if ($m == $extension) {
          $type = $key;
          break;
        }
      }
    }
  }

  $isValidFile = file_exists($filePath);
  ?>
    @if($isMultiple)
        <select name="select{{$name}}" id="mimes{{$name}}" class="form-control">
            @foreach($mimes as $key=> $value)
            <?php
            $mimeTitle = "(  " . implode(" , ", $value) . "  )";
            if ($key == "video") {
              $title = "ویدئو ";
            } elseif ($key == "image") {
              $title = "عکس ";
            } elseif ($key == "audio") {
              $title = "صدا";
            } elseif ($key == "pdf") {
              $title = "پی دی اف";
            } else {
              $title = "سایر موارد";
            }
            $dataTitle = $title;
            $title .= " " . $mimeTitle;
            ?>
                <option
                        data-title="{{$dataTitle}}"
                        data-type="{{$key}}" @if($key==$type) selected @endif
                        class="mime{{$name}}"
                        style="font-family: Tahoma"
                        value="{{json_encode($value)}}"
                >{{$title}}</option>
            @endforeach
        </select>
    @else
    @endif

    <div class="tac mt-3">
        <span class="btn btn-success" id="select-file{{$name}}">انتخاب فایل</span>
        <span class="btn btn-danger" style="@if($object->isEditMode()) @if(!$record->$name) display: none; @endif @else display: none; @endif" id="delete-this-file{{$name}}">حذف این فایل</span>
        <input type="file" id="file{{$name}}" class="hidden"/>
        <input type="hidden" id="{{$name}}" name="{{$name}}" value="{{old($name,$fileName)}}">
        <br>
        <br>
        <div id="viewer{{$name}}" style="overflow: hidden">

        </div>
        <div class="progress-wrp" id="progress-wrp{{$name}}">
            <div class="progress-bar" id="progress-bar{{$name}}"></div>
            <div class="status" id="upload-status{{$name}}">0%</div>
        </div>
        <div style="text-align: center">
            <span class="btn btn-warning hidden mt-3" id="upload{{$name}}">آپلود فایل</span>
        </div>
    </div>
</div>

<script>
  var oldFile = null
  @if($object->isEditMode())
    oldFile = "{{$record->$name}}"
  @endif
  document.addEventListener("DOMContentLoaded", function () {
    var viewer = document.getElementById("viewer{{$name}}")
    var selectedtype = $("#mimes{{$name}}").children("option:selected").data("type")
    selectType(selectedtype, '{{$filePath}}')
    $("#select-file{{$name}}").click(function () {
      $("#file{{$name}}").click()
    })

      @if($isValidFile)
      showDeleteFileButton('{{$filPath}}')
      @endif
    function getTypeByExtension(extension) {
      var options = $("#mimes{{$name}} > option")
      for (o in options) {
        var option = options[o];
        exts = $(option).val()
        var exts = JSON.parse(exts)
        for (ext in exts) {
          if (exts[ext] === extension) {
            return $(option).data("type")
          }
        }
      }
      return null;
    }


    var mimes = $("#mimes{{$name}}");
    var mime = $("#mime{{$name}}");

    $("#mimes{{$name}} > option").on("click", function () {
      var type = $(this).data("type")
      selectType(type, null)
    })


    var result = $("#{{$name}}").val();
    if (result) {
        {{--      var filePath = "{{$baseUploadPath}}"--}}
      // filePath = filePath + "/" + result
      selectType('{{$type}}', result)
    }

    function selectType(type, filePath) {
      $("#audio{{$name}}").remove()
      $("#progress-wrp{{$name}}").removeClass("active")
      $("#upload{{$name}}").removeClass("active")
      if (type === "audio") {
        var audio = document.createElement("audio")
        audio.id = "audio{{$name}}"
        audio.setAttribute("controls", "controls")
        audio.src = filePath;
        viewer.appendChild(audio)
      } else if (type === "pdf") {
        var pdf = document.createElement("iframe")
        pdf.style.width = "400px"
        pdf.id = "audio{{$name}}"
        pdf.src = "https://drive.google.com/viewerng/viewer?embedded=true&url={{getSiteUrl()}}" + filePath;
        pdf.width = "100px"
        pdf.height = "100px"
        viewer.appendChild(pdf)
      } else if (type === "image") {
        var image = document.createElement("img")
        image.style.width = "300px"
        image.id = "audio{{$name}}"
        image.src = filePath
        viewer.appendChild(image)
      } else if (type === "video") {
        var video = document.createElement("video")
        video.id = "audio{{$name}}"
        video.setAttribute("controls", "controls")
        video.src = filePath
        video.style.width = "400px"
        viewer.appendChild(video)
        $("#upload{{$name}}").addClass("hidden")
      } else if (type === "pdf") {
        $("#upload{{$name}}").addClass("hidden")
      } else if (type === "others") {
        $("#upload{{$name}}").addClass("hidden")
      }
    }


    var changeType = function () {
      alert(1)
    }

    var Upload = function (file) {
      this.file = file;
    };

    Upload.prototype.getType = function () {
      return this.file.type;
    };
    Upload.prototype.getSize = function () {
      return this.file.size;
    };
    Upload.prototype.getName = function () {
      return this.file.name;
    };
    Upload.prototype.doUpload = function () {
      var that = this;
      var formData = new FormData();

      formData.append("method", @if($object->isEditMode())
        "patch"
        @else
          "post"
        @endif
        );
      formData.append("oldFile", oldFile);
      formData.append("file", this.file, this.getName());
      formData.append("types", $("#mimes{{$name}}").val());

      $.ajax({
        type: "POST",
        url: "{{buildRoute("uploader?path=")}}" + "{{@$object->preSave->uploadPath}}" + "&name=" +
          "{{$object->preSave->uploadName}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        xhr: function () {
          var myXhr = $.ajaxSettings.xhr();
          if (myXhr.upload) {
            myXhr.upload.addEventListener('progress', that.progressHandling, false);
          }
          return myXhr;
        },
        success: function (data) {
          if (data.status) {
            alert(data.message)
            $("#delete-this-file{{$name}}").css("display", 'inline-block')
            $("#{{$name}}").val(data.path)
            oldFile = data.path
            showDeleteFileButton(data.path)
          } else {
            warningMessage(data.message)
          }
          $("#progress-wrpvideos").removeClass("active")
        },
        error: function (error) {
          warningMessage(error)
        },
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000000
      });
    };

    Upload.prototype.progressHandling = function (event) {
      var percent = 0;
      var position = event.loaded || event.position;
      var total = event.total;
      var progress_bar_id = "#progress-wrp{{$name}}";
      $("#progress-wrp{{$name}}").addClass("active")
      if (event.lengthComputable) {
        percent = Math.ceil(position / total * 100);
      }
      $(progress_bar_id + " #progress-bar{{$name}}").css("width", +percent + "%");
      $(progress_bar_id + " #upload-status{{$name}}").text(percent + "%");
    };


    var file = null
    $("#file{{$name}}").on("change", function (e) {
      file = $(this)[0].files[0];
      if (!isValidMimes()) {
        var title = $("#mimes{{$name}}").children("option:selected").data("title");
        alert("فایل انتخاب شده " + title + " نمی باشد")
        file = null
        $("#upload{{$name}}").addClass("hidden")
      } else {
        $("#upload{{$name}}").removeClass("hidden")
        const urlObj = URL.createObjectURL(e.target.files[0]);
        $("#audio{{$name}}").attr("src", urlObj)
      }
    });


    function isValidMimes() {
      var extension = getFileExtension(file.name)
      var mimes = getValidMimes()
      for (mime in mimes) {
        if (mimes[mime] === extension) {
          return true
        }
      }
      return false
    }

    function getFileExtension(fileName) {
      var result = fileName.split(".")
      return result[result.length - 1];
    }

    function getValidMimes() {
      console.log($("#mimes{{$name}}"))
      return JSON.parse($("#mimes{{$name}}").val())
    }


    $("#upload{{$name}}").click(function () {
      if (file == null) {
        warningMessage("فایل انتخاب نشده است")
      } else {
        var upload = new Upload(file);
        upload.doUpload();
      }
    })


    function handleFiles(event) {


    }

    document.getElementById("file{{$name}}").addEventListener("change", handleFiles, false);

    if (oldFile)
      showDeleteFileButton(oldFile)

    function showDeleteFileButton(fileName) {
      $("#delete-this-file{{$name}}").css("display", 'inline-block')
      $("#delete-this-file{{$name}}").click(function () {
        confirmMessage("فایل حذف شود؟", function () {
          $.ajax({
            method: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{buildRoute("/delete-uploaded-file?path=")}}" + oldFile,
            data: {
              result: fileName
            }
          }).done(function (data) {
            if (data.status) {
              var frame = document.getElementById("audio{{$name}}")
              if (frame) {
                frame.src = null
              }

              $("#{{$name}}").val("")
              alert("فایل با موفقیت حذف شد")
              $("#delete-this-file{{$name}}").css("display", "none")
            }
          })
        })
      })
    }
  })

</script>
