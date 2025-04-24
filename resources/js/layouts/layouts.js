import "./desktop-navigation.js"
import "./mobile-navigation.js"
// import "./product-box.js"
import "./dialogable.js"
import "./cartDropdown.js"
import "./theme-switcher.js"
import "./livewire-linked.js"
import "./initText.js"
import "./popup-login.js"
import {addClickHandler} from "@/layouts/documentClickHandler.js";

window.addEventListener("DOMContentLoaded", () => {
  // window.Livewire.on("number-format-fields", function (data) {
  //
  //
  // })


})
//
// function formatToToman(number) {
//   // چک کردن ورودی معتبر
//   if (isNaN(number) || number === null) {
//     return "لطفاً یک عدد معتبر وارد کنید";
//   }
//
//   // تبدیل به عدد مطلق و نگه داشتن علامت منفی
//   let isNegative = number < 0;
//   let absNumber = Math.abs(number);
//
//   // محاسبه بخش‌های مختلف
//   let trillions = Math.floor(absNumber / 1000000000000); // تریلیون
//   let billions = Math.floor((absNumber % 1000000000000) / 1000000000); // میلیارد
//   let millions = Math.floor((absNumber % 1000000000) / 1000000); // میلیون
//   let thousands = Math.floor((absNumber % 1000000) / 1000); // هزار
//   let remainder = absNumber % 1000; // باقی‌مانده
//
//   // ساخت خروجی با فرمت فارسی
//   let parts = [];
//   if (trillions > 0) {
//     parts.push(`${trillions.toLocaleString('fa-IR')} تریلیون`);
//   }
//   if (billions > 0) {
//     parts.push(`${billions.toLocaleString('fa-IR')} میلیارد`);
//   }
//   if (millions > 0) {
//     parts.push(`${millions.toLocaleString('fa-IR')} میلیون`);
//   }
//   if (thousands > 0) {
//     parts.push(`${thousands.toLocaleString('fa-IR')} هزار`);
//   }
//   if (remainder > 0 || (trillions === 0 && billions === 0 && millions === 0 && thousands === 0)) {
//     parts.push(`${remainder.toLocaleString('fa-IR')}`);
//   }
//
//   // ترکیب بخش‌ها با "و" و اضافه کردن "تومان"
//   let result = parts.join(' و ');
//   if (isNegative) {
//     result = `منفی ${result}`;
//   }
//   return `${result} تومان`;
// }
//


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
  document.querySelectorAll(".vmpi").forEach(el=>{
    el.remove()
  })
  let tag = document.getElementById("tab-description");
  tag.classList.add("show");
})
