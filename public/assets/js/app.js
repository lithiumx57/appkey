(() => {
  let menus = document.getElementsByClassName("menu-1");
  let menuCover = document.getElementById("menu-cover");
  let leave = true;
  let maxWidth = 1200;
  let getPadding = () => {
    let extra = 0;
    let padding = (window.innerWidth - maxWidth) / 2 - extra;
    if (padding < 0) {
      padding = 0;
    }
    return padding;
  };
  for (let i = 0; i < menus.length; i++) {
    let menu = menus[i];
    menu.addEventListener("mouseover", (e) => {
      let target = e.target.getAttribute("data-target");
      if (!target) return;
      let container = document.getElementById("submenu_" + target);
      if (!container) {
        return;
      }
      let padding = getPadding();
      const rect = menu.getBoundingClientRect();
      let width = parseInt(Math.abs(rect.right - rect.left) + "");
      if (leave) menuCover.style.width = "0px";
      leave = false;
      setTimeout(function() {
        if (!leave) {
          menuCover.style.width = width + "px";
          menuCover.style.left = parseInt(rect.left - padding + "") + "px";
        }
      }, 100);
    });
    menu.addEventListener("mouseleave", (e) => {
      leave = true;
      setTimeout(function() {
        if (!leave) {
          return;
        }
        let target = e.target.getAttribute("data-target");
        if (!target) return;
        let container = document.getElementById("submenu_" + target);
        if (!container) return;
        let padding = getPadding();
        const rect = menu.getBoundingClientRect();
        let width = parseInt(Math.abs(rect.right - rect.left) + 16 + "");
        menuCover.style.left = parseInt(rect.left - padding + width / 2 - 22 + "") + "px";
        menuCover.style.width = "0";
      }, 120);
    });
  }
  document.querySelector(".search-backdrop").addEventListener("click", () => {
    let result = document.getElementById("search-popup");
    if (result) {
      result.classList.remove("active");
      document.querySelector(".search-backdrop").classList.remove("active");
    }
  });
  document.querySelector("#temp-search").addEventListener("click", () => {
    let result = document.getElementById("search-popup");
    if (result) {
      result.classList.add("active");
      document.querySelector(".search-backdrop").classList.add("active");
      document.getElementById("main-search-keyword").focus();
    }
  });
  let mainSearchKeyword = document.getElementById("main-search-keyword");
  if (mainSearchKeyword) {
    mainSearchKeyword.addEventListener("keyup", (e) => {
      if (e.key === "Enter") {
        window.location.href = "/search?q=" + mainSearchKeyword.value;
      }
    });
  }
  let mainCategories = document.getElementsByClassName("main-categories");
  for (let i = 0; i < mainCategories.length; i++) {
    mainCategories[i].addEventListener("mouseenter", (event) => {
      let target = "submenu_" + event.target.getAttribute("data-target");
      let targetTag = document.getElementById(target);
      targetTag.classList.add("show");
      setTimeout(function() {
        targetTag.classList.add("active");
      }, 20);
    });
    mainCategories[i].addEventListener("mouseleave", (event) => {
      let target = "submenu_" + event.target.getAttribute("data-target");
      let targetTag = document.getElementById(target);
      targetTag.classList.remove("active");
      setTimeout(function() {
        targetTag.classList.remove("show");
      }, 300);
    });
  }
})();
if (!window.targets) {
  window.targets = {};
}
if (!window.addClickHandler) {
  window.addClickHandler = (target, cb) => {
    if (!window.targets[target]) {
      window.targets[target] = cb;
    }
  };
}
if (!window._clickHandlerInitialized) {
  document.addEventListener("click", (event) => {
    for (let target in window.targets) {
      let tClass = target.replace(".", "");
      let tId = target.replace("#", "");
      if (event.target.classList.contains(tClass) || event.target.getAttribute("id") === tId) {
        let func = window.targets[target];
        func(event);
      }
    }
  });
  window._clickHandlerInitialized = true;
}
var addClickHandler = window.addClickHandler;
(function() {
  let mainNavigation = document.getElementsByClassName("main-navigation")[0];
  let navToggle = document.getElementsByClassName("nav-toggle")[0];
  let closeN = document.getElementsByClassName("close-nav")[0];
  let searchBackdrop = document.getElementById("x-backdrop");
  closeN.addEventListener("click", () => {
    closeNav();
  });
  if (searchBackdrop) {
    searchBackdrop.addEventListener("click", () => {
      closeNav();
    });
  }
  window.addEventListener("resize", () => {
    if (window.innerWidth > 1024) {
      closeNav();
    }
  });
  function closeNav() {
    navToggle.classList.remove("active");
    searchBackdrop.classList.remove("active");
    mainNavigation.classList.remove("active");
    setTimeout(function() {
      mainNavigation.classList.remove("show");
      searchBackdrop.classList.remove("show");
    }, 300);
  }
  function openNav() {
    navToggle.classList.add("active");
    mainNavigation.classList.add("show");
    searchBackdrop.classList.add("show");
    setTimeout(function() {
      mainNavigation.classList.add("active");
      searchBackdrop.classList.add("active");
    }, 50);
  }
  document.querySelector(".nav-toggle").addEventListener("click", () => {
    if (navToggle.classList.contains("active")) {
      closeNav();
    } else {
      openNav();
    }
  });
  document.querySelectorAll(".main-categories a");
  let mainMenu = document.getElementById("main-menu-container");
  let menuLinks = document.querySelectorAll(".main-categories > a");
  function navigateMenu() {
    mainMenu.style.right = "-350px";
  }
  for (let i = 0; i < menuLinks.length; i++) {
    menuLinks[i].addEventListener("click", function(event) {
      if (window.innerWidth > 768) {
        return;
      }
      event.preventDefault();
      event.stopPropagation();
      let target = event.target.getAttribute("data-target");
      document.querySelectorAll(".submenu").forEach(function(submenu) {
        submenu.classList.remove("m-active");
      });
      document.getElementById("submenu_" + target).classList.add("m-active");
      navigateMenu();
    });
  }
  addClickHandler("#back-to-main-menu", function() {
    closeSubmenu();
  });
  const closeSubmenu = () => {
    let mainMenu2 = document.getElementById("main-menu-container");
    mainMenu2.style.right = "0";
  };
})();
addClickHandler(".dialog-button", function(event) {
  if (event.target.classList.contains("dialog-button")) {
    let targetId = event.target.getAttribute("data-target");
    let targetTag = document.getElementById(targetId);
    if (!targetTag) return;
    let width = parseInt(event.target.getAttribute("data-width") ?? 800);
    let height = parseInt(event.target.getAttribute("data-height") ?? 600);
    showBackdrop(targetId, width, height);
    setTimeout(function() {
      targetTag.querySelector(".dialog-body").classList.add("active");
    }, 20);
    targetTag.classList.add("show");
    setTimeout(function() {
      targetTag.classList.add("active");
      targetTag.style.width = width + "px";
      targetTag.style.height = height + "px";
    }, 130);
  }
});
function dismissDialog() {
  let backdrop = document.getElementById("x-backdrop");
  let id = backdrop.getAttribute("data-id");
  backdrop.classList.remove("active");
  setTimeout(function() {
    backdrop.classList.remove("show");
  }, 3e3);
  parseInt(backdrop.getAttribute("data-width") ?? 800);
  parseInt(backdrop.getAttribute("data-height") ?? 600);
  let tag = document.getElementById(id);
  if (tag) {
    tag.classList.remove("active");
    setTimeout(function() {
      tag.classList.remove("show");
    }, 300);
  }
}
addClickHandler(".x-backdrop", dismissDialog);
function showBackdrop(targetId, width, height) {
  let backdrop = document.getElementById("x-backdrop");
  backdrop.setAttribute("data-id", targetId);
  backdrop.setAttribute("data-width", width);
  backdrop.setAttribute("data-height", height);
  backdrop.classList.add("show");
  setTimeout(function() {
    backdrop.classList.add("active");
  }, 20);
}
(() => {
  const observer = new MutationObserver((mutationsList) => {
    for (let mutation of mutationsList) {
      if (mutation.type === "attributes" && mutation.attributeName === "class") {
        if (element.classList.contains("active")) document.body.style.overflowY = "hidden";
        else document.body.removeAttribute("style");
      }
    }
  });
  const element = document.querySelector(".x-backdrop");
  observer.observe(element, { attributes: true });
  document.addEventListener("DOMContentLoaded", () => {
    window.Livewire.on("dismiss-comment", () => {
      dismissDialog();
    });
  });
})();
try {
  let hovered = false;
  let cartCaret = document.getElementById("caret-cart");
  let headerCartIcon = document.getElementById("header-cart-icon");
  headerCartIcon.onmouseover = () => {
    let container = document.getElementById("header-cart-items");
    hovered = true;
    container.classList.add("active");
    cartCaret.classList.add("active");
  };
  headerCartIcon.onmouseleave = () => {
    let container = document.getElementById("header-cart-items");
    setTimeout(function() {
      if (!hovered) {
        container.classList.remove("active");
        cartCaret.classList.remove("active");
      }
    }, 300);
    hovered = false;
  };
  let headerCartItems = document.getElementById("header-cart-items");
  headerCartItems.onmouseover = () => {
    hovered = true;
    headerCartItems.classList.add("active");
    cartCaret.classList.add("active");
  };
  headerCartItems.onmouseleave = () => {
    setTimeout(function() {
      if (!hovered) {
        headerCartItems.classList.remove("active");
        cartCaret.classList.remove("active");
      }
    }, 300);
    hovered = false;
  };
} catch (e) {
}
function switchTheme() {
  let themeLight = document.getElementById("theme-light");
  let themeDark = document.getElementById("theme-dark");
  if (document.body.classList.contains("dark")) {
    document.body.classList.remove("dark");
    themeDark.classList.remove("hidden");
    themeLight.classList.add("hidden");
    setCookie("theme", "light", 365);
  } else {
    themeDark.classList.add("hidden");
    themeLight.classList.remove("hidden");
    document.body.classList.add("dark");
    setCookie("theme", "dark", 365);
  }
}
function setCookie(name, value, days) {
  let expires = "";
  {
    const date = /* @__PURE__ */ new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1e3);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
addClickHandler(".theme-t", function(event) {
  switchTheme();
});
document.addEventListener("DOMContentLoaded", () => {
});
(function() {
  let isIframeHover = null;
  let isXHintOver = null;
  addClickHandler(".head_li", function(event) {
    try {
      let id = event.target.getAttribute("id");
      let headers = document.getElementsByClassName("header");
      document.querySelectorAll(".header").forEach((element) => {
        element.classList.remove("active");
      });
      let isDesktop = window.innerWidth > 1024;
      let top;
      if (isDesktop) {
        top = window.scrollY - 128;
      } else {
        top = window.scrollY - 64;
      }
      let header = headers[parseInt(id.replace("header_", ""))];
      const y = header.getBoundingClientRect().top + top;
      header.classList.add("active");
      let interval = setInterval(function() {
        if (header.classList.contains("active")) {
          if (header.classList.contains("color1")) {
            header.classList.remove("color1");
            header.classList.add("color2");
          } else {
            header.classList.remove("color2");
            header.classList.add("color1");
          }
        } else {
          clearInterval(interval);
          header.classList.remove("color2");
          header.classList.remove("color1");
        }
      }, 300);
      setTimeout(function() {
        header.classList.remove("active");
        header.classList.remove("color2");
        header.classList.remove("color1");
      }, 2400);
      window.scrollTo({ top: y, behavior: "smooth" });
    } catch (e) {
    }
  });
  document.querySelectorAll(".suggest").forEach((el) => {
    let result = el.getElementsByTagName("a");
    if (result.length > 0) {
      el.getElementsByTagName("a")[0].classList.add("show-in-iframe");
    }
    let tag = document.createElement("span");
    tag.innerText = "مقاله پیشنهادی";
    tag.style.color = "#ff6600";
    tag.style.fontWeight = "bold";
    el.prepend(tag);
  });
  document.addEventListener("mouseout", (event) => {
    if (event.target.classList.contains("show-in-iframe")) {
      isIframeHover = false;
      setTimeout(function() {
        if (!isIframeHover) {
          let iframes = event.target.getElementsByClassName("popup-iframe");
          if (iframes.length > 0) {
            for (let i = 0; i < iframes.length; i++) iframes[i].remove();
          }
        }
      }, 500);
    }
    if (event.target.classList.contains("x-hint")) {
      isXHintOver = false;
      setTimeout(function() {
        if (!isXHintOver) {
          let iframes = document.getElementsByClassName("popup-x-hint");
          if (iframes.length > 0) {
            for (let i = 0; i < iframes.length; i++) iframes[i].remove();
          }
        }
      }, 500);
    }
    if (event.target.classList.contains("popup-iframe")) {
      isIframeHover = false;
      setTimeout(function() {
        if (!isIframeHover) {
          let iframes = document.getElementsByClassName("popup-iframe");
          if (iframes.length > 0) {
            for (let i = 0; i < iframes.length; i++) iframes[i].remove();
          }
        }
      }, 500);
    }
    if (event.target.classList.contains("popup-x-hint")) {
      isXHintOver = false;
      setTimeout(function() {
        if (!isXHintOver) {
          let iframes = document.getElementsByClassName("popup-x-hint");
          if (iframes.length > 0) {
            for (let i = 0; i < iframes.length; i++) iframes[i].remove();
          }
        }
      }, 500);
    }
  });
  document.addEventListener("mouseover", (event) => {
    if (event.target.classList.contains("show-in-iframe")) {
      isIframeHover = true;
      let target = event.target.getAttribute("href");
      event.target.style.position = "relative";
      let iframe = document.createElement("iframe");
      iframe.src = target;
      iframe.style.position = "absolute";
      iframe.style.width = "500px";
      iframe.style.borderRadius = "12px";
      iframe.style.overflow = "hidden";
      iframe.style.height = "400px";
      iframe.style.maxWidth = "80vw";
      iframe.style.border = "0";
      iframe.classList.add("popup-iframe");
      iframe.addEventListener("mouseover", function() {
        isIframeHover = true;
      });
      iframe.onload = function() {
        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
        const body = iframeDoc.body;
        body.style.zoom = "10%";
      };
      iframe.style.left = "0";
      iframe.style.right = "0";
      iframe.style.margin = "auto";
      iframe.style.top = "-400px";
      event.target.appendChild(iframe);
    }
    if (event.target.classList.contains("x-hint")) {
      isXHintOver = true;
      let text = event.target.getAttribute("data-description");
      event.target.style.position = "relative";
      let container = document.createElement("div");
      container.innerText = text;
      container.style.position = "absolute";
      container.style.width = "300px";
      container.style.overflowY = "auto";
      container.style.borderRadius = "12px";
      container.style.overflow = "hidden";
      container.style.height = "200px";
      container.style.maxWidth = "80vw";
      container.style.border = "0";
      container.classList.add("popup-x-hint");
      container.addEventListener("mouseover", function() {
        isXHintOver = true;
      });
      container.onload = function() {
        const iframeDoc = container.contentDocument || container.contentWindow.document;
        const body = iframeDoc.body;
        body.style.zoom = "10%";
      };
      container.style.left = "0";
      container.style.right = "0";
      container.style.margin = "auto";
      container.style.top = "-200px";
      event.target.appendChild(container);
    }
  });
})();
if (typeof window.loginInterval === "undefined") {
  window.loginInterval = null;
}
document.addEventListener("DOMContentLoaded", function() {
  window.Livewire.on("refresh-timing", function(data) {
    let time = data[0].time;
    if (window.loginInterval) {
      clearInterval(window.loginInterval);
      window.loginInterval = null;
    }
    setTime(time);
    window.loginInterval = setInterval(function() {
      if (time <= 1) {
        window.Livewire.dispatch("timedout");
        clearInterval(window.loginInterval);
        window.loginInterval = null;
        return;
      }
      time--;
      setTime(time);
    }, 1e3);
  });
});
function setTime(time) {
  let minutes = Math.floor(time / 60).toString().padStart(2, "0");
  let seconds = (time % 60).toString().padStart(2, "0");
  let formattedTime = `${minutes}:${seconds}`;
  let timing = document.getElementById("login-timing");
  if (!timing) {
    clearInterval(window.loginInterval);
    window.loginInterval = null;
    return;
  }
  timing.innerHTML = formattedTime;
}
addClickHandler(".check-is-mobile-for-navigate", function(event) {
  alert(1);
  const el = event.target;
  el.addEventListener("click", function(e) {
    const isSmall = window.innerWidth <= 768;
    if (isSmall) {
      e.preventDefault();
      e.stopImmediatePropagation();
      console.log("موبایله، wire:navigate اجرا نشد");
    } else {
      console.log("not small");
    }
  });
});
document.addEventListener("keyup", (event) => {
  if (event.target.classList.contains("number-format")) {
    let value = event.target.value;
    value = value.replace(/[^0-9]/g, "");
    if (value) {
      let numberValue = parseInt(value);
      let formatted = numberValue.toLocaleString("en-US");
      event.target.value = formatted;
    } else {
      event.target.value = "";
    }
  }
});
addClickHandler(".vmpi", (event) => {
  document.querySelectorAll(".vmpi").forEach((el) => {
    el.remove();
  });
  let tag = document.getElementById("tab-description");
  tag.classList.add("show");
});
(function() {
  let sortToast = () => {
    let container = document.querySelectorAll(".toast-container");
    let toastContainerCount = document.getElementsByClassName("toast-container").length;
    for (let i = 0; i < toastContainerCount; i++) {
      container[i].style.top = 12 + i * 70 + "px";
    }
  };
  let dismissScheduler = (container, time) => {
    setTimeout(function() {
      dismissToast(container);
    }, time);
  };
  let dismissToast = (container) => {
    try {
      container.style.top = "-100px";
      setTimeout(() => {
        container.remove();
        sortToast();
      }, 200);
    } catch (e) {
    }
  };
  document.addEventListener("DOMContentLoaded", () => {
    window.Livewire.on("toast", (data) => {
      data = data[0];
      let _message = data.message;
      let type = data.type;
      let time = parseInt(data.time) * 1e3;
      let container = document.createElement("div");
      let message = document.createElement("div");
      let close = document.createElement("div");
      close.innerHTML = "X";
      container.style.height = "60px";
      container.style.alignItems = "center";
      let toastContainerCount = document.getElementsByClassName("toast-container").length;
      setTimeout(function() {
        container.style.top = 12 + toastContainerCount * 70 + "px";
      }, 20);
      container.classList.add("toast-container");
      container.classList.add(type);
      message.classList.add("message");
      close.classList.add("close");
      message.innerHTML = _message;
      container.appendChild(message);
      container.appendChild(close);
      close.addEventListener("click", () => dismissToast(container));
      dismissScheduler(container, time);
      document.body.appendChild(container);
    });
  });
})();
