import {showToast,getToken} from "./helpers";

const helper = document.getElementById("x-helpers")
const admin = helper.getAttribute('data-admin-prefix')

$(".right-sidebar .switcher li").click(function () {
  let newTheme = $(this).attr("data-theme-class")

  $.ajax({
    url:  admin + "/" + "change-theme",
    method: "POST",
    ...getToken(),
    data: {
      newTheme,
    }
  }).done(function (data) {
    if (data.status){
      showToast(data.message)
    }
  })
})
