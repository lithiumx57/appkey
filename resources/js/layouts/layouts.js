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
