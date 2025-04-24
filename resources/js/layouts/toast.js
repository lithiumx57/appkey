let sortToast = () => {
  let container = document.querySelectorAll(".toast-container")
  let toastContainerCount = document.getElementsByClassName("toast-container").length
  for (let i = 0; i < toastContainerCount; i++) {
    container[i].style.top = (12 + i * 70) + "px"
  }
}
let dismissScheduler = (container, time) => {
  setTimeout(function () {
    dismissToast(container)
  }, time)
}
let dismissToast = (container) => {
  try {
    container.style.top = "-100px"
    setTimeout(() => {
      container.remove()
      sortToast()
    }, 200)
  } catch (e) {
  }
}
document.addEventListener("DOMContentLoaded", () => {
  window.Livewire.on("toast", (data) => {
    data = data[0];

    let _message = data.message
    let type = data.type
    let time = parseInt(data.time) * 1000

    let container = document.createElement("div")
    let message = document.createElement("div")
    let close = document.createElement("div")
    close.innerHTML = "X"


    container.style.height = 60 + "px"
    container.style.alignItems ="center"

    let toastContainerCount = document.getElementsByClassName("toast-container").length
    setTimeout(function () {
      container.style.top = (12 + toastContainerCount * 70) + "px"
    }, 20)

    container.classList.add("toast-container")
    container.classList.add(type)
    message.classList.add("message")
    close.classList.add("close")

    message.innerHTML = _message
    container.appendChild(message)
    container.appendChild(close)

    close.addEventListener("click", () => dismissToast(container))
    dismissScheduler(container, time)
    document.body.appendChild(container)

  })
})
