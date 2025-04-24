new Swiper(".main-slider", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 30000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 1.2,
      spaceBetween: 8,
    },
    440: {
      slidesPerView: 1.2,
      spaceBetween: 8,
    },
    570: {
      slidesPerView: 1.3,
      spaceBetween: 8,
    },

    640: {
      slidesPerView: 1.3,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 1.4,
      spaceBetween: 8,
    },
    900: {
      slidesPerView: 1.5,
      spaceBetween: 8,
    },
    1024: {
      slidesPerView:1.6,
      spaceBetween: 12,
    },
    1300: {
      slidesPerView: 1.63,
      spaceBetween: 12,
    },
  },


  pagination: {
    el: ".slider-swiper-pagination",
  },
  slidesPerView: 1.1,
  spaceBetween: 30,
  centeredSlides: true,
  loop: true,

});

new Swiper(".product-slider", {
  slidesPerView: 2.8,
  spaceBetween: 8,

  breakpoints: {
    0: {
      slidesPerView: 2.8,
      spaceBetween: 8,
    },
    440: {
      slidesPerView: 2.5,
      spaceBetween: 8,
    },
    570: {
      slidesPerView: 2.7,
      spaceBetween: 8,
    },

    640: {
      slidesPerView: 3.1,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 3.5,
      spaceBetween: 8,
    },
    900: {
      slidesPerView: 4,
      spaceBetween: 8,
    },
    1024: {
      slidesPerView: 4.8,
      spaceBetween: 12,
    },
    1300: {
      slidesPerView: 5.8,
      spaceBetween: 12,
    },
  },

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

new Swiper(".category-slider", {
  slidesPerView: 4,
  spaceBetween: 8,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 4.2,
      spaceBetween: 8,
    },
    440: {
      slidesPerView: 5,
      spaceBetween: 8,
    },
    570: {
      slidesPerView: 5.2,
      spaceBetween: 8,
    },

    640: {
      slidesPerView: 6.1,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 7.2,
      spaceBetween: 8,
    },


  },
});

new Swiper(".blog-slider", {
  spaceBetween: 8,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 3,
      spaceBetween: 8,
    },
    440: {
      slidesPerView: 2.1,
      spaceBetween: 8,
    },
    570: {
      slidesPerView: 2.8,
      spaceBetween: 8,
    },

    640: {
      slidesPerView: 3.1,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 3.6,
      spaceBetween: 8,
    },
    900: {
      slidesPerView: 4.1,
      spaceBetween: 8,
    },
    1024: {
      slidesPerView: 4.8,
      spaceBetween: 12,
    },
    1300: {
      slidesPerView: 5.8,
      spaceBetween: 12,
    },
  },
});
