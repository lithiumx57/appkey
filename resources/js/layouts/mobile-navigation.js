import {addClickHandler} from "@/layouts/documentClickHandler.js";

(function () {

  let mainNavigation = document.getElementsByClassName("main-navigation")[0]
// let searchBackdrop = document.getElementsByClassName("search-backdrop")[0]
  let navToggle = document.getElementsByClassName("nav-toggle")[0]
  let closeN = document.getElementsByClassName("close-nav")[0]

  let searchBackdrop = document.getElementById("x-backdrop")

  closeN.addEventListener("click", () => {
    closeNav()
  })

  if (searchBackdrop) {
    searchBackdrop.addEventListener("click", () => {
      closeNav()
    })
  }

  window.addEventListener("resize", () => {
    if (window.innerWidth > 1024) {
      closeNav()
    }
  })


  function closeNav() {
    navToggle.classList.remove("active")
    searchBackdrop.classList.remove("active")
    mainNavigation.classList.remove("active")
    setTimeout(function () {
      mainNavigation.classList.remove("show")
      searchBackdrop.classList.remove("show")
    }, 300)
  }

  function openNav() {
    navToggle.classList.add("active")
    mainNavigation.classList.add("show")
    searchBackdrop.classList.add("show")
    setTimeout(function () {
      mainNavigation.classList.add("active")
      searchBackdrop.classList.add("active")
    }, 50)

  }

  document.querySelector(".nav-toggle").addEventListener("click", () => {
    if (navToggle.classList.contains("active")) {
      closeNav()
    } else {
      openNav()
    }
  })


  let categories = document.querySelectorAll(".main-categories a")


  let mainMenu = document.getElementById("main-menu-container");
  let menuLinks = document.querySelectorAll(".main-categories > a")


  function navigateMenu() {
    mainMenu.style.right = "-350px"
  }

  for (let i = 0; i < menuLinks.length; i++) {
    menuLinks[i].addEventListener("click", function (event) {
      if (window.innerWidth > 768) {
        return;
      }
      event.preventDefault()
      event.stopPropagation()

      let target = event.target.getAttribute("data-target")

      document.querySelectorAll(".submenu").forEach(function (submenu) {
        submenu.classList.remove("m-active")
      })

      document.getElementById("submenu_" + target).classList.add("m-active")

      navigateMenu()
    })
  }

  addClickHandler("#back-to-main-menu", function () {
    closeSubmenu()
  })

  const closeSubmenu = () => {
    let mainMenu = document.getElementById("main-menu-container");
    mainMenu.style.right = "0"
  }


})()
