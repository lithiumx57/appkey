const {dialog} = require("./../helpers/dialog");
const {confirmMessage} = require("./../helpers/alert");


document.addEventListener("DOMContentLoaded", function () {
  const {dialog} = require("./../helpers/dialog")
  const {confirmMessage} = require("./../helpers/alert")

  const appHelper = document.getElementById("x-helpers")

  let pusherAppKey = appHelper.getAttribute("data-pusher-app-key");

  let notificationBody = $(".notification-body")

  let defaultUpdateNotificationEvent = notificationBody.data('categories-update-notification-event')
  let userNotificationEvent = notificationBody.data('user-notification-event')
  let myChannel = notificationBody.data('my-channel')


  let pusher = new Pusher(pusherAppKey, {
    cluster: 'ap2'
  });


  class PusherHandler {
    constructor() {
      this.initReceivers()
    }

    initReceivers() {
      let channel = this.getMyChannel()
      channel.bind(userNotificationEvent, function (data) {


        let count = $(".notification-count").text()
        let notificationCount = parseInt(count) + 1
        updateCount(notificationCount)
        showInNotifications(data)
        if (data.popup) {
          dialog({
            title: data.title,
            description: data.description
          })
          $(".no-notification").removeClass("active")
        }
        initEvents()
      })

      channel.bind(defaultUpdateNotificationEvent, function (data) {
        if (data.mode === "seen") {
          let seenCount = data.data.seenCount
          let notificationId = data.data.notificationId
          $("#view_count_" + notificationId).empty().append(seenCount)
        }
      })
    }

    getMyChannel() {
      return pusher.subscribe(myChannel);
    }
  }


  setTimeout(function () {
    new PusherHandler()
  }, 2000)


  let seen = $(".notification-row .seen")
  let remove = $(".notification-row .delete-notification")


  initEvents()

  function initEvents() {
    seen.click(function () {
      $.ajax({
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/seen-notification",
        data: {
          notificationId: $(this).data("id"),
        }
      }).done((data) => {
        if (data.status) {
          $(this).addClass("active")
          let notificationCount = data.notificationCount
          updateCount(notificationCount)
        }
      })
    })

    remove.click(function () {
      confirmMessage({
        message: "اعلان حذف شود؟",
        onYesClicked: () => {
          $.ajax({
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/delete-notification",
            data: {
              notificationId: $(this).data("id"),
            }
          }).done((data) => {
            if (data.status) {
              $(this).parents(".notification-row").remove()
            }

            if (data.notificationCount === 0) {
              $(".no-notification").addClass("active")
            }
            updateCount(data.notificationCount)
          })
        }
      })

    })

    seen.hover(function () {
      $(this).find(".view").addClass("active")
    }, function () {
      $(this).find(".view").removeClass("active")
    })

    $(".header-menu-icon").click(function () {
      $(this).find(".notification-body").addClass("active")
    })
  }


  document.addEventListener("click", function (event) {
    console.log(event.target)

    if ($(event.target).hasClass("notification-count") ||
      $(event.target).hasClass("toggle-notification") ||
      $(event.target).hasClass("fa-bell")) {
      return
    }

    if ($(event.target).parents(".notification-body").length > 0) {
      return;
    }
    let notificationBody = $(".notification-body")
    notificationBody.removeClass("active")
  })

  function showInNotifications(data) {
    let tag = '<li class="notification-row">\n' +
      '                <span class="fa fa-check seen " data-id="' + data.notificationId + '" title="دیدم">\n' +
      '                  <span id="view_count_' + data.notificationId + '" class="view">0</span>\n' +
      '                </span>\n' +
      '                <span class="delete-notification fa fa-times" data-id="' + data.notificationId + '" title="حذف کردن"></span>\n' +
      '                <span class="avatar fa fa-check"></span>\n' +
      '                <span class="name">' + data.title + '</span>\n' +
      '                <span class="body">\n' +
      data.description +
      '              </span>\n' +
      '              </li>'

    $("#notification-wrapper").append(tag)
    initEvents()
  }

})


function updateCount(notificationCount) {
  let notificationCountTag = $(".notification-count")
  if (notificationCount === 0) {
    notificationCountTag.removeClass("active")
  } else {
    notificationCountTag.addClass("active")
  }
  notificationCountTag.empty().append(notificationCount)
}


