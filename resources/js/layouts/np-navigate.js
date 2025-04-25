// import "./custom-navigate.js"


// document.addEventListener('livewire:navigate', () => {
// CustomProgress.start();
// });

// بعد از اتمام ناوبری، پیشرفت رو تکمیل کن
// document.addEventListener('livewire:navigated', () => {
//   // CustomProgress.done();
// });

// if (typeof window.NProgress === "undefined") {
//   import("nprogress").then(module => {
//     // اگر NProgress هنوز بارگذاری نشده
//     const NProgress = module.default;
//
//     // ذخیره کردن NProgress در window تا از بارگذاری دوباره جلوگیری بشه
//     window.NProgress = NProgress;
//
//     // پیکربندی و استفاده از NProgress
//     NProgress.configure({ showSpinner: false });
//     NProgress.start();
//
//     document.addEventListener('livewire:navigate', () => {
//       NProgress.start();
//     });
//
//     document.addEventListener('livewire:navigated', () => {
//       NProgress.done();
//     });
//
//     document.addEventListener('livewire:navigating', () => {});
//   }).catch(err => {
//     console.error('Error loading NProgress:', err);
//   });
// } else {
//   // اگر NProgress از قبل بارگذاری شده بود، از همون نسخه استفاده کن
//   window.NProgress.start();
// }
