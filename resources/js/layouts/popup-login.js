let interval = null;

document.addEventListener("DOMContentLoaded", function () {
  window.Livewire.on("refresh-timing", function (data) {
    let time = data[0].time
    if (interval) {
      clearInterval(interval)
      interval = null;
    }
    setTime(time)

    interval = setInterval(function () {
      if (time <= 1) {
        window.Livewire.dispatch("timedout")
        clearInterval(interval)
        interval = null
        return;
      }
      time--;
      setTime(time)
    }, 1000)

  })
})

function setTime(time) {
  let minutes = Math.floor(time / 60).toString().padStart(2, "0");
  let seconds = (time % 60).toString().padStart(2, "0");
  let formattedTime = `${minutes}:${seconds}`;
  let timing = document.getElementById("login-timing")
  if (!timing) {
    clearInterval(interval)
    interval = null
    return
  }
  timing.innerHTML = formattedTime
}
