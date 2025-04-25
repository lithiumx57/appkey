(function (global) {
  if (global.CustomProgress) return; // اگر قبلاً تعریف شده، دوباره تعریف نکن

  // ایجاد نوار پیشرفت
  const progressElement = document.createElement("div");
  progressElement.style.position = "fixed";
  progressElement.style.top = "0";
  progressElement.style.left = "0"; // شروع از سمت چپ
  progressElement.style.width = "0%";
  progressElement.style.height = "4px";
  progressElement.style.backgroundColor = "#29d";
  progressElement.style.transition = "width 0.4s ease-in-out";
  progressElement.style.zIndex = "9999";
  document.body.appendChild(progressElement);

  let currentProgress = 0;
  let progressInterval;

  // تابع برای شروع پیشرفت
  const startProgress = () => {
    currentProgress = 0;
    progressElement.style.width = `${currentProgress}%`;
    progressElement.style.display = "block";  // نمایش نوار پیشرفت
    progressInterval = setInterval(() => {
      if (currentProgress < 90) {  // پیشرفت تا 90%
        currentProgress += 1;
        progressElement.style.width = `${currentProgress}%`;
      }
    }, 50);
  };

  // تابع برای تکمیل پیشرفت (تا 100%)
  const completeProgress = () => {
    clearInterval(progressInterval);
    progressElement.style.width = "100%"; // نوار پیشرفت به 100% می‌رسد
  };

  // تابع برای مخفی کردن نوار پیشرفت
  const hideProgress = () => {
    progressElement.style.display = "none"; // نوار پیشرفت مخفی می‌شود
  };

  // تابع برای تنظیم مقدار پیشرفت به درصد دلخواه
  const setProgress = (percentage) => {
    currentProgress = percentage;
    progressElement.style.width = `${currentProgress}%`;
  };

  // تابع برای ریست کردن پیشرفت
  const resetProgress = () => {
    clearInterval(progressInterval);
    progressElement.style.width = "0%";
    progressElement.style.display = "none";
  };

  // ذخیره کردن در global window
  global.CustomProgress = {
    start: startProgress,
    done: completeProgress,
    hide: hideProgress,
    set: setProgress,
    reset: resetProgress,
  };

})(window);
