import {addClickHandler} from "@/layouts/documentClickHandler.js";


addClickHandler(".dialog-button", function (event) {
  if (event.target.classList.contains("dialog-button")) {
    let targetId = event.target.getAttribute("data-target")
    let targetTag = document.getElementById(targetId)
    if (!targetTag) return;

    let width = parseInt(event.target.getAttribute("data-width") ?? 800)
    let height = parseInt(event.target.getAttribute("data-height") ?? 600)


    showBackdrop(targetId, width, height)

    setTimeout(function () {
      targetTag.querySelector(".dialog-body").classList.add("active")
    }, 20)


    targetTag.classList.add("show")
    setTimeout(function () {
      targetTag.classList.add("active")
      targetTag.style.width = width + "px"
      targetTag.style.height = height + "px"
    }, 130)
  }
})


function dismissDialog(){
  let backdrop = document.getElementById("x-backdrop")
  let id = backdrop.getAttribute("data-id")
  backdrop.classList.remove("active")

  setTimeout(function () {
    backdrop.classList.remove("show")
  }, 3000)


  let width = parseInt(backdrop.getAttribute("data-width") ?? 800)
  let height = parseInt(backdrop.getAttribute("data-height") ?? 600)

  let tag = document.getElementById(id)


  // tag.style.width = (width - 30) + "px"
  // tag.style.height = (height - 30) + "px"

  tag.classList.remove("active")
  setTimeout(function () {
    tag.classList.remove("show")
  }, 300)


  try {
    // tag.querySelector(".dialog-body").classList.remove("active")

  } catch (e) {
  }
}
addClickHandler(".x-backdrop", dismissDialog)


let showBackdrop = (targetId, width, height) => {
  let backdrop = document.getElementById("x-backdrop")
  backdrop.setAttribute("data-id", targetId)
  backdrop.setAttribute("data-width", width)
  backdrop.setAttribute("data-height", height)

  backdrop.classList.add("show")
  setTimeout(function () {
    backdrop.classList.add("active")
  }, 20)
}


const observer = new MutationObserver((mutationsList) => {
  for (let mutation of mutationsList) {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      if (element.classList.contains("active")) document.body.style.overflowY = "hidden"
      else document.body.removeAttribute("style")
    }
  }
});
const element = document.querySelector(".x-backdrop");
observer.observe(element, {attributes: true});


document.addEventListener("DOMContentLoaded", () => {
  window.Livewire.on("dismiss-comment", () => {
    dismissDialog()
  })
})

