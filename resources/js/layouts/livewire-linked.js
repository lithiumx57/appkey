import {addClickHandler} from "@/layouts/documentClickHandler.js";

document.addEventListener("DOMContentLoaded", () => {
  // addClickHandler(".livewire-mode", function (event) {
  //
  //
  //
  //   event.preventDefault();
  //   event.stopPropagation();
  //
  //
  //   let emit = event.target.getAttribute("data-emit");
  //   let changeUrl = event.target.getAttribute("data-change-url") === "true";
  //   let listener = event.target.getAttribute("data-listener");
  //
  //
  //
  //   window.Livewire.dispatch(listener, {data: emit});
  //
  //   if (changeUrl) {
  //     const newPath = event.target.getAttribute("href");
  //     const state = {
  //       path: newPath,
  //       emit: emit,
  //       listener: listener,
  //       isCustomPush: true // پرچم برای تشخیص pushState خودمون
  //     };
  //     window.history.pushState(state, "", newPath);
  //     // console.log("PushState:", state); // دیباگ
  //   }
  // });
  //

})
// window.addEventListener("popstate", (event) => {
//   const state = event.state;
//   const path = window.location.pathname;
//   if (state && state.isCustomPush && state.path === path && state.listener) {
//     // console.log("بازگشت برای URL سفارشی - Listener:", state.listener, "Emit:", state.emit);
//     window.Livewire.dispatch(state.listener, {data: state.emit});
//   } else {
//
//   }
// })
