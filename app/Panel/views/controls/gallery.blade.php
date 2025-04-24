<div id="dZUpload" class="dropzone">
  <div class="dz-default dz-message x-drop">فایل های خود را اینجا رها کنید</div>
  <textarea name="{{$name}}" id="{{$name}}" cols="30" rows="10"></textarea>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    let tag = document.getElementById("{{$name}}")
    //here
    Dropzone.autoDiscover = false;
    $("#dZUpload").dropzone({
      url: "{{buildRoute("gallery-upload")}}",



      addRemoveLinks: true,
      success: function (file, response) {
        let path = "";
        if (response.isArray) {
          path = response.path[response.index]
        } else {
          path = response.path[1200]
        }

        file.previewElement.classList.add("dz-success");

      },
      error: function (file, response) {
        file.previewElement.classList.add("dz-error");
      },

      sending: function (file, xhr, formData) {
        formData.append("model", '{{str_replace("\\",".",$model)}}');
        formData.append("field", '{{str_replace("\\",".",$name)}}');
      }

    });

  })
</script>
