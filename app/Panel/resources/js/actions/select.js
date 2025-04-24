const {showToast, confirmMessage} = require("./../helpers");
let helpers = document.getElementById("x-helpers");
let adminPrefix = helpers.getAttribute("data-admin-prefix")


function sendRequest(tag) {
  const value = tag.val()
  const recordId = tag.data("record-id")
  const model = tag.data("model")
  const isMethod = tag.data("is-method")
  const method = tag.data("method")
  const field = tag.data("field")

  $.ajax({
    url: "/" + adminPrefix + "/action-select",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",
    data: {
      value,
      field,
      model,
      recordId,
      method,
      isMethod
    }
  }).done(function (data) {
    if (!data.status) {
      showToast(data.message, "warning")
    } else {
      showToast(data.message)
    }
  })
}

module.exports = {
  init: (tag) => {
    $(tag).on("change", function () {
      const confirmable = $(this).data("confirmable")

      if (confirmable) {
        confirmMessage("از تغییر فیلد مطمئن هستید ؟ ", () => {
          sendRequest($(this))
        })
      } else {
        sendRequest($(this))
      }


    })
    // alert(tag.data("model"))
  }
}
