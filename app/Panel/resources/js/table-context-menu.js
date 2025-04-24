let menuContainer = null
let recordId = null

$(".tr-record").on("contextmenu", function (event) {
  event.stopPropagation()
  event.preventDefault()
  recordId = $(this).attr("id")

  let actions = JSON.parse($(".tr-record").attr("data-action"))
  removeContextMenu()
  initializeContainer(event.clientX, event.clientY)
  addActions(actions)

  showContextMenu()

  let ACTION_RELOAD = document.createEvent("Event")
  ACTION_RELOAD.initEvent("ACTION_RELOAD", true, true)
  window.document.dispatchEvent(ACTION_RELOAD)

})

function getLink(row) {
  let link = document.createElement("a")

  link.style.color = "#222222"

  let textContainer = document.createElement("span")
  let icon = document.createElement("i")
  icon.setAttribute("class", row.classes)
  textContainer.style.paddingRight = "8px"
  textContainer.style.verticalAlign = "middle"
  icon.style.verticalAlign = "middle"
  textContainer.innerHTML = row.title

  if (row.link !== "#") {
    link.setAttribute("href", row.link)
  }

  link.appendChild(icon)
  link.appendChild(textContainer)
  return link
}

function addActions(actions) {
  actions.map(row => {
    let li = document.createElement("li")

    li.style.cursor = "pointer"
    li.style.borderBottom = "1px solid #888"
    li.style.padding = "8px"
    li.style.paddingRight = "8px"
    li.style.transition = "500ms"

    li.appendChild(getLink(row))


    $(li).hover(function () {
      li.style.background = "#aaa"
    }, function () {
      li.style.background = "#fff"
    })

    for (let attr in row.attributes) {
      li.setAttribute("data-" + attr, row.attributes[attr])
    }
    li.setAttribute("data-type",row.type)
    li.setAttribute("data-record-id",row.recordId)

    li.classList.add("x-action")
    menuContainer.appendChild(li)
  })
}


function showContextMenu() {
  document.getElementById("wrapper").appendChild(menuContainer)
  $(menuContainer).slideDown(60)
}


function removeContextMenu() {
  menuContainer = null
  let result = document.getElementById("tr-context-menu")
  if (result) result.remove()
}

document.addEventListener("click", (event) => {
  let target = $(event.target);
  // console.log(target.parents("#tr-context-menu"))
  if (target.attr("id") === "tr-context-menu" || target.parents("#tr-context-menu").length > 0) {
    return;
  }
  removeContextMenu()
})


window.onresize=function (){
  removeContextMenu()
}

function initializeContainer(x, y) {
  menuContainer = document.createElement("ul")
  menuContainer.style.position = "absolute"
  menuContainer.id = "tr-context-menu"

  if (x - 200 < 20) {
    menuContainer.style.left = x + 'px'
  } else {
    menuContainer.style.left = x - 200 + 'px'
  }

  menuContainer.style.top = y + "px"
  menuContainer.style.display = "none"
  menuContainer.style.overflow = "hidden"
  menuContainer.style.color = "#222222"
  menuContainer.style.listStyle = "none"
  menuContainer.style.padding = "0"
  menuContainer.style.margin = "0"
  menuContainer.style.lineHeight = "25px"
  menuContainer.style.borderRadius = 4 + "px"
  menuContainer.style.boxShadow = "2px 2px 2px 2px #333333"
  menuContainer.style.width = "200px"
  menuContainer.style.display = "none"
  menuContainer.style.height = "auto"
  menuContainer.style.background = "#eeeeee"
  menuContainer.style.transition = "500ms";
  menuContainer.style.display = "block";

}
