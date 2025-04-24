import {getChecked, showToast, confirmMessage} from './helpers'

let helper = document.getElementById("x-helpers")
let domain = helper.getAttribute("data-domain")

$(function () {
  let checked = getChecked()
  if (checked.length > 0) {
    $(".dropdown-item.disabled").removeClass("disabled")
  } else {
    $(".dropdown-item[data-enable-check='1']").addClass("disabled")
  }
})


// $(".dropdown-item").click(function (event) {
//   let type = $(this).attr("data-type")
//   if (type === "DEFAULT_OPTION_CREATE") {
//     event.preventDefault()
//     event.stopPropagation()
//     let link = $(this).attr("href")
//     navigateTo(link)
//   }
// })
$(".dropdown-item.disabled").click(function () {
  const link = $(this).data("link");
  const type = $(this).data('type')
  let checked = getChecked();
  if (checked.length === 0) {
    showToast("هیچ موردی انتخاب نشده", "error")
    return;
  }

  if (type === "DEFAULT_OPTION_DELETE") {

    confirmMessage("سطر های انتخاب شده حذف شوند؟", function () {
      $.ajax({
        url: link,
        type: 'DELETE',
        data: {
          records: getChecked()
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      }).done(function (data) {
        if (data.status) {
          showToast("عملیات با موفقیت انجام شد")
          setTimeout(function (){
            window.location.reload()
          },2000)

        }

      });
    })
  } else if (type === "DEFAULT_OPTION_EDIT") {
    if (checked.length > 1) {
      showToast("شما نمی توانید بیشتر از یک مورد را ویرایش کنید", "error")
      return;
    }
    let id = checked[0]
    window.location.href = link.replace("/id/", "/" + id + "/")
  } else if (type === "CUSTOM") {
    const option = $(this).data("options");
    let link = option.link;
    const enableCheck = option.enableCheck;

    if (enableCheck) {
      link = link + "&records=" + getChecked()
    }

    $.ajax({
      url: link,
    }).done(function (data) {
      if (data.status) {
        showToast("عملیات با موفقیت انجام شد")
        reload()
      }
    })

  } else if (type === "DEFAULT_OPTION_RESTORE") {
    confirmMessage("سطر های انتخاب شده بازیابی شوند؟", function () {
      $.ajax({
        url: link,
        type: 'DELETE',
        data: {
          records: getChecked(),
          mode: "restore"
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      }).done(function (data) {
        if (data.status) {
          showToast("عملیات با موفقیت انجام شد")
          reload()
        }

      });
    })
  }


})

//
// function reload() {
//   let link = window.location.href
//   navigateTo(link)
// }

// export function navigateTo(link) {
//   link = link.replace(domain, "")
//   const myEvent = new CustomEvent("AJAX_GO_TO_URL", {
//     detail: {
//       target: link
//     }
//   });
//   document.dispatchEvent(myEvent);
// }
