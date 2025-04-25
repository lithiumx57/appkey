new Swiper(".main-slider", {
  on: {
    click(swiper, event) {
      const target = event.target.closest("a[wire\\:navigate]");
      if (target) {
        const simulatedClick = new MouseEvent("click", {
          bubbles: true,
          cancelable: true,
          view: window
        });
        target.dispatchEvent(simulatedClick);
      }
    }
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  autoplay: {
    delay: 3e4,
    disableOnInteraction: false,
    pauseOnMouseEnter: true
  },
  breakpoints: {
    0: {
      slidesPerView: 1.2,
      spaceBetween: 8
    },
    440: {
      slidesPerView: 1.2,
      spaceBetween: 8
    },
    570: {
      slidesPerView: 1.3,
      spaceBetween: 8
    },
    640: {
      slidesPerView: 1.3,
      spaceBetween: 8
    },
    768: {
      slidesPerView: 1.4,
      spaceBetween: 8
    },
    900: {
      slidesPerView: 1.5,
      spaceBetween: 8
    },
    1024: {
      slidesPerView: 1.6,
      spaceBetween: 12
    },
    1300: {
      slidesPerView: 1.63,
      spaceBetween: 12
    }
  },
  pagination: {
    el: ".slider-swiper-pagination"
  },
  slidesPerView: 1.1,
  spaceBetween: 30,
  centeredSlides: true,
  loop: true
});
new Swiper(".product-slider", {
  on: {
    click(swiper, event) {
      const target = event.target.closest("a[wire\\:navigate]");
      if (target) {
        const simulatedClick = new MouseEvent("click", {
          bubbles: true,
          cancelable: true,
          view: window
        });
        target.dispatchEvent(simulatedClick);
      }
    }
  },
  slidesPerView: 2.8,
  spaceBetween: 8,
  breakpoints: {
    0: {
      slidesPerView: 2.8,
      spaceBetween: 8
    },
    440: {
      slidesPerView: 2.5,
      spaceBetween: 8
    },
    570: {
      slidesPerView: 2.7,
      spaceBetween: 8
    },
    640: {
      slidesPerView: 3.1,
      spaceBetween: 8
    },
    768: {
      slidesPerView: 3.5,
      spaceBetween: 8
    },
    900: {
      slidesPerView: 4,
      spaceBetween: 8
    },
    1024: {
      slidesPerView: 4.8,
      spaceBetween: 12
    },
    1300: {
      slidesPerView: 5.8,
      spaceBetween: 12
    }
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  }
});
new Swiper(".category-slider", {
  on: {
    click(swiper, event) {
      const target = event.target.closest("a[wire\\:navigate]");
      if (target) {
        const simulatedClick = new MouseEvent("click", {
          bubbles: true,
          cancelable: true,
          view: window
        });
        target.dispatchEvent(simulatedClick);
      }
    }
  },
  slidesPerView: 4,
  spaceBetween: 8,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  breakpoints: {
    0: {
      slidesPerView: 4.2,
      spaceBetween: 8
    },
    440: {
      slidesPerView: 5,
      spaceBetween: 8
    },
    570: {
      slidesPerView: 5.2,
      spaceBetween: 8
    },
    640: {
      slidesPerView: 6.1,
      spaceBetween: 8
    },
    768: {
      slidesPerView: 7.2,
      spaceBetween: 8
    }
  }
});
new Swiper(".blog-slider", {
  on: {
    click(swiper, event) {
      const target = event.target.closest("a[wire\\:navigate]");
      if (target) {
        const simulatedClick = new MouseEvent("click", {
          bubbles: true,
          cancelable: true,
          view: window
        });
        target.dispatchEvent(simulatedClick);
      }
    }
  },
  spaceBetween: 8,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  breakpoints: {
    0: {
      slidesPerView: 3,
      spaceBetween: 8
    },
    440: {
      slidesPerView: 2.1,
      spaceBetween: 8
    },
    570: {
      slidesPerView: 2.8,
      spaceBetween: 8
    },
    640: {
      slidesPerView: 3.1,
      spaceBetween: 8
    },
    768: {
      slidesPerView: 3.6,
      spaceBetween: 8
    },
    900: {
      slidesPerView: 4.1,
      spaceBetween: 8
    },
    1024: {
      slidesPerView: 4.8,
      spaceBetween: 12
    },
    1300: {
      slidesPerView: 5.8,
      spaceBetween: 12
    }
  }
});
(function() {
  class Carousel3dAuto extends HTMLElement {
    constructor() {
      super();
      if (this.shadowRoot) return;
      const frameWidth = this.getAttribute("data-width") || 150;
      const frameHeight = this.getAttribute("data-height") || 100;
      this.frameWidth = frameWidth;
      this.frameHeight = frameHeight;
      this.frames = [];
      this.currentAngle = 0;
      this.increment = 0.5;
      this.initialized = false;
      this.attachShadow({ mode: "open" });
      this.shadowRoot.innerHTML = this.getTemplate();
    }
    connectedCallback() {
      if (this.initialized) return;
      this.initialized = true;
      this.overlay = this.shadowRoot.querySelector(".overlay");
      this.carouselContainer = this.shadowRoot.querySelector(".carousel-container");
      this.primaryWindow = this.shadowRoot.querySelector(".primary-window");
      this.frameContainer = this.shadowRoot.querySelector(".frame-container");
      this.shadowContainer = this.shadowRoot.querySelector(".shadow-container");
      const frames = Array.from(this.children);
      const radius = this.frameWidth * frames.length / (1.2 * 3.2);
      this.primaryWindow.style.translate = `0 0 ${radius}px`;
      frames.forEach((frame, i) => {
        const fullFrame = frame.cloneNode(true);
        const shadow = frame.cloneNode(true);
        shadow.classList.add("shadow");
        this.frames.push(frame);
        frame.style.transformOrigin = `50% 50% ${-radius}px`;
        frame.style.translate = `0 0 ${radius}px`;
        frame.initialRotation = 360 / frames.length * i;
        frame.rotation = frame.initialRotation;
        frame.style.rotate = `y ${frame.initialRotation}deg`;
        frame.addEventListener("click", () => {
        });
        this.overlay.addEventListener("click", (event) => {
          if (event.target !== this.overlay) return;
          this.overlay.classList.remove("open");
          fullFrame.classList.remove("open");
        });
        const shadowWrap = document.createElement("div");
        shadowWrap.classList.add("shadow-wrap");
        shadowWrap.style.transformOrigin = `50% 50% ${-radius}px`;
        shadowWrap.style.translate = `0 0 ${radius}px`;
        shadowWrap.style.rotate = `y ${360 / frames.length * i}deg`;
        shadowWrap.appendChild(shadow);
        this.shadowContainer.appendChild(shadowWrap);
        this.overlay.appendChild(fullFrame);
      });
      this.midX = this.clientWidth / 2;
      this.midY = this.clientHeight / 2;
      this.rotateCarousel();
      this.setupListeners();
    }
    setupListeners() {
      this.carouselContainer.addEventListener("mousemove", (event) => {
        this.carouselContainer.style.removeProperty("transition");
        const containerRect = this.getBoundingClientRect();
        const mouseY = event.clientY - containerRect.top;
        const percentY = (mouseY - this.midY) / this.midY * 30 + 30;
        this.carouselContainer.style.perspectiveOrigin = `50% ${percentY}%`;
        const mouseX = event.clientX - containerRect.left;
        if (mouseX > this.midX - 25 && mouseX < this.midX + 25) {
          this.increment = 0;
        } else {
          const percentX = (mouseX - this.midX) / this.midX;
          this.increment = 360 / (150 / percentX);
        }
      });
      this.carouselContainer.addEventListener("mouseout", () => {
        this.carouselContainer.style.perspectiveOrigin = "50% 30%";
        this.carouselContainer.style.transition = "perspective-origin .5s ease-in-out";
      });
      window.addEventListener("resize", () => {
        this.midX = this.clientWidth / 2;
        this.midY = this.clientHeight / 2;
      });
    }
    rotateCarousel() {
      if (this.currentAngle % 360 > -Math.abs(this.increment) && this.currentAngle % 360 < Math.abs(this.increment)) {
        this.currentAngle = 0;
        this.frames.forEach((frame) => frame.rotation = frame.initialRotation);
      }
      this.frames.forEach((frame) => {
        frame.rotation += this.increment;
        this.applyOpacity(frame);
      });
      this.currentAngle += this.increment;
      this.frameContainer.style.transform = `rotateY(${this.currentAngle}deg)`;
      requestAnimationFrame(() => this.rotateCarousel());
    }
    applyOpacity(frame) {
      const rotation = frame.rotation % 360;
      if (rotation >= 0 && rotation <= 45 || rotation >= 315 && rotation <= 360) {
        frame.style.opacity = "1";
      } else if (rotation > 45 && rotation <= 90 || rotation >= 270 && rotation < 315) {
        frame.style.opacity = "0.8";
      } else if (rotation > 90 && rotation <= 135 || rotation >= 225 && rotation < 270) {
        frame.style.opacity = "0.6";
      } else {
        frame.style.opacity = "0.4";
      }
    }
    getTemplate() {
      return `
        <style>
          :host {
            display: inline-block;
            width: 100%;
            height: 100%;
          }
          .overlay {
            position: fixed;
            display: grid;
            place-items: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,.6);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
          }
          .overlay > * {
            position: absolute;
            width: 70%;
            height: 70%;
            border-radius: 9px;
            opacity: 0;
            object-fit: cover;
          }
          .carousel-container {
            display: grid;
            place-items: center;
            width: 100%;
            height: 100%;
            perspective: 1000px;
            perspective-origin: 50% 30%;
            overflow: hidden;
          }
          .floor {
            position: absolute;
            width: 400%;
            height: 400%;
            background-size: 100%, 100px 100px;
            transform: translateY(${this.frameHeight / 2 + 20}px) rotateX(90deg);
          }
          .frame-container {
            position: absolute;
            width: ${this.frameWidth}px;
            height: ${this.frameHeight}px;
            transform-style: preserve-3d;
          }
          .shadow-container, .shadow-wrap {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
          }
          .shadow-wrap {
            transform: translateY(calc(50% + 20px));
          }
          .shadow {
            transform: rotateX(-90deg) translateY(-${this.frameHeight / 2}px);
            -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,.7), transparent 70%);
            mask-image: linear-gradient(to top, rgba(0,0,0,.7), transparent 70%);
          }
          ::slotted(*), .shadow {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 5px;
            background-color: transparent;
            transition: opacity 0.5s;
          }
          ::slotted(*) {
            cursor: pointer;
          }
        </style>
        <div class="carousel-container">
          <div class="floor"></div>
          <div class="frame-container">
            <slot></slot>
            <div class="shadow-container"></div>
          </div>
          <div class="primary-window"></div>
        </div>
        <div class="overlay"></div>
      `;
    }
  }
  if (!customElements.get("carousel-3d-auto")) {
    customElements.define("carousel-3d-auto", Carousel3dAuto);
  } else {
    document.querySelectorAll("carousel-3d-auto").forEach((el) => {
      if (typeof el.connectedCallback === "function") {
        el.connectedCallback();
      }
    });
  }
})();
