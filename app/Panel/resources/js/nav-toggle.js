import {getToken} from "./helpers";

const helper = document.getElementById("x-helpers")
const admin = helper.getAttribute('data-admin-prefix')


$(".topbar-nav .toggle-menu").click(function () {
  $.ajax({
    url:  admin + "/" + "toggle-navigation-menu",
    method: "POST",
    ...getToken(),
  }).done(function (data) {
    if (data.status) {
      showToast(data.message)
    }
  })
})
