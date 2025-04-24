const {confirmMessage, showToast} = require("./../helpers");

module.exports = {
  init: function (url) {
    confirmMessage("رکورد حذف شود؟", function () {
      $.ajax({
        url,
        type: "DELETE",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (data) {
        if (data.status) {
          showToast("عملیات با موفقیت انجام شد")
          setTimeout(function () {
            window.location.reload()
          }, 200)
        } else {
          showToast(data.message, "warning")
        }
      })
    })
  },

  deleteForEver: function (url) {
    confirmMessage("رکورد برای همیشه شود؟", function () {
      $.ajax({
        url,
        type: "DELETE",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (data) {
        if (data.status) {
          showToast("عملیات با موفقیت انجام شد")
          setTimeout(function () {
            window.location.reload()
          }, 200)
        }
      })
    })
  },


  restore: function (url) {
    confirmMessage("رکورد بازیابی شود؟", function () {
      $.ajax({
        url,
        type: "DELETE",
        data: {
          mode: "restore"
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (data) {
        if (data.status) {
          showToast("عملیات با موفقیت انجام شد")
          setTimeout(function () {
            window.location.reload()
          }, 200)
        }
      })
    })
  }
}
