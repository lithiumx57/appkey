import "./desktop-navigation.js"
import "./mobile-navigation.js"
import "./dialogable.js"
import "./cartDropdown.js"
import "./theme-switcher.js"
import "./livewire-linked.js"
import "./initText2.js"
import "./popup-login.js"
import "./np-navigate.js"
import {addClickHandler} from "@/layouts/documentClickHandler.js";


addClickHandler(".check-is-mobile-for-navigate", function (event) {
  alert(1)
  const el = event.target;


  el.addEventListener('click', function (e) {
    const isSmall = window.innerWidth <= 768;

    if (isSmall) {
      e.preventDefault();
      e.stopImmediatePropagation();
      console.log("موبایله، wire:navigate اجرا نشد");
    } else {
      console.log("not small")
    }
  });
})

document.addEventListener("keyup", (event) => {
  if (event.target.classList.contains("number-format")) {

    let value = event.target.value;
    value = value.replace(/[^0-9]/g, "");
    if (value) {
      let numberValue = parseInt(value);

      let formatted = numberValue.toLocaleString('en-US');
      event.target.value = formatted;

    } else {
      event.target.value = ""; // اگر چیزی وارد نشده یا همه چیز حذف شده
    }
  }
});


addClickHandler(".vmpi", (event) => {
  document.querySelectorAll(".vmpi").forEach(el => {
    el.remove()
  })
  let tag = document.getElementById("tab-description");
  tag.classList.add("show");
})
