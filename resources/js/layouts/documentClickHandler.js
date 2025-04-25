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


export var addClickHandler = window.addClickHandler;
