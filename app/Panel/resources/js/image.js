import {confirmMessage, showToast} from "./helpers";

const helper = document.getElementById("x-helpers")
const admin = helper.getAttribute('data-admin-prefix')

document.addEventListener("DOMContentLoaded", function () {
  const buttonSelectImages = $('.select-image')

  for (let i = 0; i < buttonSelectImages.length; i++) {
    let button = $(buttonSelectImages[i])
    let name = button.data('name')
    $('#selectImage' + name).click(function () {
      $("#file" + name).click()
    })


    $('#file' + name).on('change', function (event) {
      const fr = new FileReader()
      fr.readAsDataURL(event.target.files[0])
      fr.onload = function () {
        let image = document.getElementById('image' + name)
        image.src = fr.result;
        document.getElementById("selectImage" + name).innerText = "تغییر تصویر"
        document.getElementById("text" + name).innerText = event.target.files[0].name
        document.getElementById("text" + name + "Container").style.display = "block"
      }
    })

    $('#deleteImage' + name).click(function () {
      confirmMessage("فایل حذف شود؟", function () {
        let src = $("#image-helper" + name).data('path')
        $.ajax({
          url:  admin + "/delete-uploaded-file",
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data: {
            path: src
          }
        }).done(function () {
          $("#image" + name).attr("src", "")
          showToast("فایل با موفقیت حذف شد")

        })
      });


    })


  }

})

