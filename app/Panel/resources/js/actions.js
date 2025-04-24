const {showToast, confirmMessage} = require("./helpers");
const select = require("./actions/select");
const handler = require("./actions/action-handler");


document.addEventListener("ACTION_RELOAD", () => {
  const actions = $('.x-action')
  const actionSelect = document.getElementsByClassName("x-action-select")

  const select = require("./actions/select")
  const handler = require("./actions/action-handler")

  for (let i = 0; i < actionSelect.length; i++) select.init(actionSelect[i])

  for (let i = 0; i < actions.length; i++) {
    const action = $(actions[i]);

    action.click(function () {
      if ($(this).data('is-link-mode') === 1) {

        // window.location.href = $(this).data("link")
      } else {
        handler.actionHandler({
          type: action.data('type'),
          link: action.data("link"),
          data: action
        })
      }
    })
  }


  $(".x-action-popup .header .fa-times").click(function () {
    $('.popup-container').removeClass("active")
  })


  document.addEventListener("click", function (event) {
    if ($(event.target).hasClass("active")) {
      $('.popup-container').removeClass("active")
    }
  })
})

reload()

function reload() {
  let ACTION_RELOAD = document.createEvent("Event")
  ACTION_RELOAD.initEvent("ACTION_RELOAD", true, true)
  window.document.dispatchEvent(ACTION_RELOAD)
}
