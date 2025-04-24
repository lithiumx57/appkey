const {showToast, confirmMessage} = require("./../helpers");

const popupContainer = $(".popup-container");
const popupBody = $(".popup-container .body");


let helpers = document.getElementById("x-helpers");
let adminPrefix = helpers.getAttribute("data-admin-prefix")

function buildStyles(tag) {
  let minWidth = tag.data("min-width")
  let minHeight = tag.data("min-height")
  let maxWidth = tag.data("max-width")
  let maxheight = tag.data("max-height")
  let width = tag.data("width")
  let height = tag.data("height")
  let backgroundColor = tag.data("background-color")
  let headerBackgroundColor = tag.data("header-background-color")
  let headerTextColor = tag.data("header-text-color")
  let textColor = tag.data("text-color")
  let textAlign = tag.data("text-align")
  let direction = tag.data("direction")

  let topPadding = tag.data("top-padding")
  let bottomPadding = tag.data("bottom-padding")
  let leftPadding = tag.data("left-padding")
  let rightPadding = tag.data("right-padding")

  showLoading(textColor, height)


  popupContainer.find('.body').css("paddingTop", topPadding + "px")
  popupContainer.find('.body').css("paddingBottom", bottomPadding + "px")
  popupContainer.find('.body').css("paddingLeft", leftPadding + "px")
  popupContainer.find('.body').css("paddingRight", rightPadding + "px")

  popupContainer.find('.body').css("height", height - 30 + "px")

  popupContainer.find('.x-action-popup').css("background", backgroundColor)

  popupContainer.find('.x-action-popup').css("width", width + "px")
  popupContainer.find('.x-action-popup').css("height", height + "px")

  popupContainer.find('.x-action-popup').css("min-width", minWidth + "px")
  popupContainer.find('.x-action-popup').css("min-height", minHeight + "px")
  popupContainer.find('.x-action-popup').css("direction", direction)


  popupContainer.find('.x-action-popup').css("max-width", maxWidth + "px")
  popupContainer.find('.x-action-popup').css("max-height", maxheight + "px")

  popupContainer.find('.header').css("color", headerTextColor)
  popupContainer.find('.header').css("background", headerBackgroundColor)

  popupContainer.find('.body').css("color", textColor)
  popupContainer.find('.body').css("text-align", textAlign)

}

function onShowing(tag) {

  let closeByClickOns = tag.data("close-by-click-on")
  const tags = closeByClickOns.split(",")
  tags.map(tag => {
    $(tag).click(function () {
      popupContainer.removeClass("active")
    })
  })


}


function showLoading(textColor, height) {
  let text = "در حال بارگیری لطفا صبر کنید...";
  popupBody.empty().append(
    "<h6 style='line-height: " + height + "px;text-align: center;color: " + textColor + "'>" + text + "</h6>"
  )
}

function dismissLoading() {
  popupBody.empty()
}

function dismissDialog() {
  popupContainer.removeClass("active");
}

function buildMethod(tag) {
  let model = tag.data("model")
  let method = tag.data("method")
  let recordId = tag.data("record-id")
console.log(tag)
  $.ajax({
    url: "/" + adminPrefix + "/" + "popup-action",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: "POST",
    data: {
      model, method, recordId
    }
  }).done(function (data) {
    dismissLoading()
    if (!data.status) {
      dismissDialog()
      return showToast(data.message, "warning")
    }

    popupBody.empty().append(data.content)

  })
}

module.exports = {
  showPopup: (tag) => {
    buildStyles(tag)
    popupContainer.find('.body').empty()

    let headerTitle = tag.data("header-title")
    let content = tag.data("content")

    popupContainer.find(".title").html(headerTitle)


    let isMethod = tag.data("is-method")==true

    if (isMethod) {
      buildMethod(tag)
    } else {
      popupBody.html(content)
    }


    popupContainer.addClass("active")


    onShowing(tag)

  }
}
