let helper = document.getElementById("x-helpers")
let domain = helper.getAttribute("data-domain")


function initPopupImage() {
  let image = $(".show-popup-image");
  image.unbind()
  image.on("click", function () {
    let largeImage = $(this).attr("data-large-image")

    let div = document.createElement("div")
    div.style.backgroundColor = "rgba(71,71,71,.3)"
    div.style.position = "fixed"
    div.style.top = "0px"
    div.style.bottom = "0px"
    div.style.right = "0px"
    div.style.left = "0px"
    div.style.left = "0px"
    div.style.zIndex = "9999999999999999"

    let image = document.createElement("img")
    image.src = largeImage
    image.style.width = "600px"
    image.style.position = "absolute"
    image.style.left = "0"
    image.style.top = "0"
    image.style.right = "0"
    image.style.bottom = "0"
    image.style.margin = "auto auto"
    image.style.maxWidth = "80%"
    image.style.borderRadius = "8px"
    image.style.boxShadow = "0 0 7px 2px #333"

    div.appendChild(image)
    div.addEventListener("click", function () {
      div.remove()
    })


    document.body.appendChild(div)
  })
}

function initRouter() {
  let router = $(".router a")
  router.unbind()
  router.click(function (event) {

    let target = $(this).attr("href");
    if (!isLink(target)) return;

    event.preventDefault()
    event.stopPropagation()


    $(".router").find("li").removeClass("active")
    $(this).parent().addClass("active")
    goToPage(target, function () {
      // reloadAjax()
    })
  })
}

function isLink(target) {
  if (!target || target === "#") return false;


  if (target === "javascript:void(0)") {
    return false;
  }
  return true;
}

function initPagination() {
  let pagination = $(".pagination a")
  pagination.unbind()
  pagination.click(function (event) {
    event.stopPropagation()
    event.preventDefault()

    let oldUrl = $(this).attr("href")
    oldUrl = oldUrl.replace(domain, "")
    goToPage(oldUrl, function () {
      // reloadAjax()
    })
  })
}

function initSwitch() {
  let _switch = $(".switch-button")
  _switch.unbind()
  _switch.click(function (event) {
    event.stopPropagation()
    event.preventDefault()
    let oldUrl = window.location.href
    oldUrl = oldUrl.replace(domain, "")

    let target = $(this).attr("href");
    if (!isLink(target)) return;

    goToPage(target, function () {
      goToPage(oldUrl, function () {
        // reloadAjax()
      })
    })
  })
}

function initDropdownOptions() {
  let dropdownOption = $("#dropdown-options a")
  dropdownOption.unbind()
  dropdownOption.click(function (event) {
    event.preventDefault()
    event.stopPropagation()
    let target = $(this).data("link");

    if (target === undefined) {
      target = $(this).attr("href");
    }

    if (!isLink(target)) {
      return;
    }


    let data = [];

    let result = document.getElementsByClassName("x-checkbox")
    for (let i = 0; i < result.length; i++) {
      data.push(result[i].getAttribute("data-id"))
    }

    goToPage(target, function () {
      // reloadAjax()
    }, data)
  })
}

function initSearch() {
  let search = $("#search-keyword")
  search.unbind()
  search.on("keyup", function (e) {
    if (e.key === "Enter") {
      let keyword = e.target.value;
      let target = $(this).attr("data-target")
      if (target.includes("?")) {
        target += "&q=" + keyword
      } else {
        target += "?q=" + keyword
      }
      goToPage(target, function () {
        // reloadAjax()
      })
    }
  })
}

function initDepends() {
  const myEvent = new CustomEvent("DEPENDS_RELOAD", {
    detail: {}
  });
  document.dispatchEvent(myEvent);
}


function initActions() {
  $(".x-action[data-link]").click(function (event) {
    if ($(this).data("is-link-mode") != "1") {
      return;
    }
    event.preventDefault()
    event.stopPropagation()
    let link = $(this).attr("data-link")
    goToPage(link, function () {
      reloadAjax()
    })
  })

}

function reloadAjax() {
  return;
  initPopupImage()
  // initRouter()
  initPagination()
  // initSwitch()
  initDepends()
  // initActions()
  // initDropdownOptions()
  initSearch()

  $(".action-td .x-action[data-is-link-mode='1']").click(function (event) {
    // event.preventDefault()
    // event.stopPropagation()
  })

  let ACTION_RELOAD = document.createEvent("Event")
  ACTION_RELOAD.initEvent("ACTION_RELOAD", true, true)
  window.document.dispatchEvent(ACTION_RELOAD)

}


window.addEventListener('popstate', function (event) {
  return;

  let href = event.target.location.href
  href = href.replace(domain, "")
  if (href.includes("#")) return;

  goToPage(href, function () {
    reloadAjax()
  })
});


reloadAjax()

function goToPage(target, cb = null, data = []) {

  if (!isLink(target)) return;


  if (target.startsWith("/")) window.location.href = target;
  else window.location.href = "/" + target;


  return;

  if (!target.startsWith("/")) {
    target = "/" + target
  }

  target.replace("//", "/")

  window.history.pushState("", "", target)

  $(".loading-cover").addClass("active")
  $.ajax({
    url: target,
    data: {
      renderType: "partial",
      ...data
    },
  }).done(function (data) {
    $("#main-content").empty().append(data)
    $(".loading-cover").removeClass("active")

    let DOMContentLoaded_event = document.createEvent("Event")
    DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)
    window.document.dispatchEvent(DOMContentLoaded_event)
    if (cb != null) cb()
  })
}


document.addEventListener("AJAX_GO_TO_URL", (event) => {
  goToPage(event.detail.target)
});
