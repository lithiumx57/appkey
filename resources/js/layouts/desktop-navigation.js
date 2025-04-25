(()=>{

  let menus = document.getElementsByClassName("menu-1")
  let menuCover = document.getElementById("menu-cover")
  let leave = true
  let maxWidth = 1200


  let getPadding = () => {
    let extra = 0;
    let padding = (window.innerWidth - maxWidth) / 2 - extra
    if (padding < 0) {
      padding = 0
    }
    return padding
  }

  for (let i = 0; i < menus.length; i++) {
    let menu = menus[i]
    menu.addEventListener("mouseover", (e) => {
      let target = e.target.getAttribute("data-target")
      if (!target) return;

      let container = document.getElementById("submenu_" + target)
      if (!container) {
        return
      }

      let padding = getPadding()

      const rect = menu.getBoundingClientRect();
      let width = parseInt(Math.abs(rect.right - rect.left) + "")

      if (leave) menuCover.style.width = "0px";

      leave = false

      setTimeout(function () {
        if (!leave) {
          menuCover.style.width = width + "px"
          menuCover.style.left = parseInt(rect.left - padding + "") + "px"
        }
      }, 100)
    })

    menu.addEventListener("mouseleave", (e) => {


      leave = true
      setTimeout(function () {
        if (!leave) {
          return;
        }

        let target = e.target.getAttribute("data-target")
        if (!target) return;
        let container = document.getElementById("submenu_" + target)
        if (!container) return;


        let padding = getPadding()
        const rect = menu.getBoundingClientRect();
        let width = parseInt((Math.abs(rect.right - rect.left) + 16) + "")
        menuCover.style.left = parseInt(rect.left - padding + (width / 2) - 22 + "") + "px"
        menuCover.style.width = "0"
      }, 120)
    })
  }


  document.querySelector(".search-backdrop").addEventListener("click", () => {
    let result = document.getElementById("search-popup")
    if (result) {
      result.classList.remove("active")
      document.querySelector(".search-backdrop").classList.remove("active")
    }
  })


  document.querySelector("#temp-search").addEventListener("click", () => {
    let result = document.getElementById("search-popup")
    if (result) {
      result.classList.add("active")
      document.querySelector(".search-backdrop").classList.add("active")
      document.getElementById("main-search-keyword").focus()
    }
  })

  let mainSearchKeyword = document.getElementById("main-search-keyword")
  if (mainSearchKeyword) {

    mainSearchKeyword.addEventListener("keyup", (e) => {
      if (e.key === "Enter") {
        window.location.href = "/search?q=" + mainSearchKeyword.value
      }
    })
  }


  let mainCategories = document.getElementsByClassName("main-categories")

  for (let i = 0; i < mainCategories.length; i++) {
    mainCategories[i].addEventListener("mouseenter", (event) => {
      let target = "submenu_" + event.target.getAttribute("data-target")
      let targetTag = document.getElementById(target)
      targetTag.classList.add("show")
      setTimeout(function () {
        targetTag.classList.add("active")
      }, 20)
    })

    mainCategories[i].addEventListener("mouseleave", (event) => {
      let target = "submenu_" + event.target.getAttribute("data-target")
      let targetTag = document.getElementById(target)
      targetTag.classList.remove("active")
      setTimeout(function () {
        targetTag.classList.remove("show")
      }, 300)
    })
  }


})()
