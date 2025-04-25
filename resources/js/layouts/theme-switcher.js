import {addClickHandler} from "@/layouts/documentClickHandler.js";


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
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}


addClickHandler(".theme-t", function (event) {
  switchTheme()
});



