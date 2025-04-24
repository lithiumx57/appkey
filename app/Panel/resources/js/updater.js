import {getAdminPrefix,showSwal} from "./helper";

$(function () {

  let adminPrefix = getAdminPrefix()

  const url = window.location.href;
  if (url.includes('/panel')) {

    function numberFormat(x) {
      x = x.toString();
      var pattern = /(-?\d+)(\d{1})/;
      while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
      return x + "مگابایت ";
    }

    let panelVersion = document.getElementById("panel-version")


    panelVersion = parseFloat(panelVersion.getAttribute("data-version"))


    const getToken = () => {
      return {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }
    }
    $.ajax({
      url: adminPrefix + "check-for-update",
      ...getToken(),
      method: "POST",
    }).done(function (data) {

      // data = JSON.parse(data)
      var status = $("#status")
      status.addClass("active")

      data = JSON.parse(data)

      if (data.version > panelVersion) {
        var updatePanel = $("#update-panel")
        updatePanel.addClass("active")

        status.empty().append('به روز رسانی جدید وجود دارد ( حجم ' + parseFloat(numberFormat(data.size / 1024 / 1024)) + ' )' + "( ورژن نسخه جدید :  " + data.version + ")")
      } else {
        status.empty().append('شما بروز ترین نسخه پنل را دارید')
      }

      if (updatePanel) {
        updatePanel.click(function () {

          $.ajax({
            url: adminPrefix + "update-panel",
            ...getToken(),
            method: "POST",
            data: {
              version: data.version,
              path: data.path,
              type: data.type
            }

          }).done(function (data) {
            if (data.status) {
              status.empty().append('شما بروز ترین نسخه پنل را دارید')
              showSwal("به روز رسانی با موفقیت انجام شد")
              updatePanel.removeClass('active')
            }
          })
        })
      }
    })
  }

})
