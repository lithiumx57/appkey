import {addClickHandler} from "@/layouts/documentClickHandler.js";

addClickHandler(".head_li", function (event) {
  try {
    let id = event.target.getAttribute("id")
    let headers = document.getElementsByClassName("header")

    document.querySelectorAll(".header").forEach(element => {
      element.classList.remove("active");
    });

    let isDesktop = window.innerWidth > 1024
    let top
    if (isDesktop) {
      top = window.scrollY - 128
    } else {
      top = window.scrollY - 64
    }


    let header = headers[parseInt(id.replace("header_", ""))]
    const y = header.getBoundingClientRect().top + top;

    header.classList.add("active")


    let interval = setInterval(function () {
      if (header.classList.contains("active")) {
        if (header.classList.contains("color1")) {
          header.classList.remove("color1")
          header.classList.add("color2")
        } else {
          header.classList.remove("color2")
          header.classList.add("color1")
        }
      } else {
        clearInterval(interval)
        header.classList.remove("color2")
        header.classList.remove("color1")
      }
    }, 300)


    setTimeout(function () {
      header.classList.remove("active")
      header.classList.remove("color2")
      header.classList.remove("color1")
    }, 2400)


    window.scrollTo({top: y, behavior: "smooth"});
  } catch (e) {

  }

})

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".suggest").forEach((el) => {

    let result = el.getElementsByTagName("a")
    if (result.length > 0) {
      el.getElementsByTagName("a")[0].classList.add("show-in-iframe")
    }
    let tag = document.createElement("span");


    tag.innerText = "مقاله پیشنهادی";
    tag.style.color = "#ff6600";
    tag.style.fontWeight = "bold";
    el.prepend(tag);
  });
});

let isIframeHover = null;
let isXHintOver = null;
document.addEventListener("mouseout", (event) => {

  if (event.target.classList.contains("show-in-iframe")) {
    isIframeHover = false
    setTimeout(function () {
      if (!isIframeHover) {
        let iframes = event.target.getElementsByClassName("popup-iframe")
        if (iframes.length > 0) {
          for (let i = 0; i < iframes.length; i++) iframes[i].remove()
        }
      }
    }, 500)
  }

  if (event.target.classList.contains("x-hint")) {
    isXHintOver = false
    setTimeout(function () {
      if (!isXHintOver) {
        let iframes = document.getElementsByClassName("popup-x-hint")
        if (iframes.length > 0) {
          for (let i = 0; i < iframes.length; i++) iframes[i].remove()
        }
      }
    }, 500)
  }

  if (event.target.classList.contains("popup-iframe")) {
    isIframeHover = false
    setTimeout(function () {
      if (!isIframeHover) {
        let iframes = document.getElementsByClassName("popup-iframe")
        if (iframes.length > 0) {
          for (let i = 0; i < iframes.length; i++) iframes[i].remove()
        }
      }
    }, 500)
  }

  if (event.target.classList.contains("popup-x-hint")) {
    isXHintOver = false
    setTimeout(function () {
      if (!isXHintOver) {
        let iframes = document.getElementsByClassName("popup-x-hint")
        if (iframes.length > 0) {
          for (let i = 0; i < iframes.length; i++) iframes[i].remove()
        }
      }
    }, 500)
  }

})

document.addEventListener("mouseover", (event) => {
  if (event.target.classList.contains("show-in-iframe")) {
    isIframeHover = true

    let target = event.target.getAttribute("href")
    event.target.style.position = "relative"
    let iframe = document.createElement("iframe")

    iframe.src = target
    iframe.style.position = "absolute"
    iframe.style.width = "500px"
    iframe.style.borderRadius = "12px"
    iframe.style.overflow = "hidden"
    iframe.style.height = "400px"
    iframe.style.maxWidth = "80vw"
    iframe.style.border = "0"
    iframe.classList.add("popup-iframe")
    iframe.addEventListener("mouseover", function () {
      isIframeHover = true
    })

    iframe.onload = function () {
      const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
      const body = iframeDoc.body;
      body.style.zoom = "10%";
    }


    iframe.style.left = "0"
    iframe.style.right = "0"
    iframe.style.margin = "auto"
    iframe.style.top = "-400px"
    event.target.appendChild(iframe)

  }


  if (event.target.classList.contains("x-hint")) {
    isXHintOver = true

    let text = event.target.getAttribute("data-description")
    event.target.style.position = "relative"
    let container = document.createElement("div")
    container.innerText = text
    container.style.position = "absolute"
    container.style.width = "300px"
    container.style.overflowY = "auto"
    container.style.borderRadius = "12px"
    container.style.overflow = "hidden"
    container.style.height = "200px"
    container.style.maxWidth = "80vw"
    container.style.border = "0"
    container.classList.add("popup-x-hint")
    container.addEventListener("mouseover", function () {
      isXHintOver = true
    })

    container.onload = function () {
      const iframeDoc = container.contentDocument || container.contentWindow.document;
      const body = iframeDoc.body;
      body.style.zoom = "10%";
    }


    container.style.left = "0"
    container.style.right = "0"
    container.style.margin = "auto"
    container.style.top = "-200px"
    event.target.appendChild(container)

  }
})



