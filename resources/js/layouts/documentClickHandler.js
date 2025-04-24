let targets = {}


document.addEventListener("click", (event) => {

  for (let target in targets) {
    let tClass = target.replace(".", "")
    let tId = target.replace("#", "")

    if (event.target.classList.contains(tClass)) {
      let func = targets[target]
      func(event)
    }

    if (event.target.getAttribute("id") === tId) {
      let func = targets[target]
      func(event)
    }
  }
})

let addClickHandler = (target, cb) => {
  if (!targets[target]) {
    targets[target] = cb
  }
}


export {
  addClickHandler
}


