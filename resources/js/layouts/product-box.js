// function scrollSlider(button, direction) {
//   const boxSlider = button.closest('.product-slider-container').querySelector('.box-slider');
//   const scrollAmount = 220;
//
//
//   if (direction === 1 && boxSlider.scrollLeft + boxSlider.clientWidth >= boxSlider.scrollWidth) {
//     boxSlider.scrollTo({left: 0, behavior: "smooth"});
//   } else if (direction === -1 && boxSlider.scrollLeft <= 0) {
//     boxSlider.scrollTo({left: boxSlider.scrollWidth, behavior: "smooth"});
//   } else {
//     boxSlider.scrollBy({left: direction * scrollAmount, behavior: "smooth"});
//   }
// }


// document.querySelectorAll(".box-next").forEach(row => {
//   row.addEventListener("click", () => {
//     scrollSlider(row, -1)
//   })
// })

// document.querySelectorAll(".box-prev").forEach(row => {
//   row.addEventListener("click", () => {
//     scrollSlider(row, 1)
//   })
//
//   row.click()
//   row.click()
//   row.click()
//   row.click()
//   row.click()
//   row.click()
//
// })



// document.querySelectorAll('.box-slider').forEach(boxSlider => {
//   let isDown = false;
//   let startX;
//   let scrollLeft;
//
//   // برای ماوس (دسکتاپ)
//   boxSlider.addEventListener("mousedown", (e) => {
//     if (e.target.tagName === "IMG") e.preventDefault();
//     isDown = true;
//     boxSlider.classList.add("active");
//     startX = e.pageX - boxSlider.offsetLeft;
//     scrollLeft = boxSlider.scrollLeft;
//   });
//
//   window.addEventListener("mouseup", () => {
//     isDown = false;
//     boxSlider.classList.remove("active");
//   });
//
//   boxSlider.addEventListener("mouseleave", () => {
//     isDown = false;
//     boxSlider.classList.remove("active");
//   });
//
//   boxSlider.addEventListener("mousemove", (e) => {
//     if (!isDown) return;
//     e.preventDefault();
//     const x = e.pageX - boxSlider.offsetLeft;
//     const walk = x - startX;
//     boxSlider.scrollLeft = scrollLeft - walk;
//   });
//
//   // برای لمس (موبایل)
//   boxSlider.addEventListener("touchstart", (e) => {
//     isDown = true;
//     boxSlider.classList.add("active");
//     startX = e.touches[0].pageX - boxSlider.offsetLeft;
//     scrollLeft = boxSlider.scrollLeft;
//   });
//
//   boxSlider.addEventListener("touchend", () => {
//     isDown = false;
//     boxSlider.classList.remove("active");
//   });
//
//   boxSlider.addEventListener("touchmove", (e) => {
//     if (!isDown) return;
//     e.preventDefault();
//     const x = e.touches[0].pageX - boxSlider.offsetLeft;
//     const walk = x - startX;
//     boxSlider.scrollLeft = scrollLeft - walk;
//   });
//
//   // غیر فعال کردن قابلیت درگ روی تصاویر
//   boxSlider.querySelectorAll("img").forEach(img => {
//     img.setAttribute("draggable", "false");
//   });
// });
