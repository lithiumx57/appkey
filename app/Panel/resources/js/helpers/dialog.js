function dialog({title,description}) {
  let cover = document.createElement("div")
  cover.style.position = "fixed"
  cover.style.left = "0"
  cover.style.top = "0"
  cover.style.bottom = "0"
  cover.style.right = "0"
  cover.style.width = "100%"
  cover.style.height = "100%"
  cover.style.zIndex = "9999999999999"
  cover.style.background = "rgba(71,71,71,.6)"

  let container = document.createElement("div")
  container.style.left = "0"
  container.style.top = "0"
  container.style.bottom = "0"
  container.style.right = "0"
  container.style.position = "absolute"
  container.style.width = "800px"
  container.style.height = "600px"
  container.style.margin = "auto auto"
  container.style.borderRadius = "8px"
  container.style.overflow = "hidden"

  container.style.zIndex = "99999999999999"
  container.style.background = "#ffffff"


  let header = document.createElement("div")
  header.style.top = "0"
  header.style.position = "absolute"
  header.style.width = "100%"
  header.style.height = "40px"
  header.style.lineHeight = "40px"
  header.style.paddingRight = "8px"
  header.style.background = "#24beb9"
  header.style.color = "#fff"
  header.innerHTML = title

  let content = document.createElement("div")
  content.style.top = "40px"
  content.style.position = "absolute"
  content.style.width = "100%"
  content.style.height = "calc(100% - 40px)"
  content.style.lineHeight = "40px"
  content.style.paddingRight = "8px"
  content.style.background = "#fff"
  content.style.color = "#222"
  content.innerHTML = description

  let closeIcon = document.createElement("i")
  closeIcon.classList.add("fa", "fa-times")
  closeIcon.style.cursor = "pointer"
  closeIcon.style.position = "absolute"
  closeIcon.style.left = "12px"
  closeIcon.style.top = "12px"

  closeIcon.addEventListener("click", () => {
    cover.remove()
  })


  header.appendChild(closeIcon)
  container.appendChild(content)
  container.appendChild(header)


  cover.appendChild(container)
  document.body.appendChild(cover)
}



module.exports={
  dialog
}
