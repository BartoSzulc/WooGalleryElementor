import Swiper from "swiper";
import SwiperCore, {
  Navigation,
  Pagination,
  Lazy,
  EffectFade,
  Autoplay,
  Thumbs,
  Controller,
  FreeMode,
} from "swiper/core";
// configure Swiper to use modules
SwiperCore.use([
  Navigation,
  Pagination,
  Lazy,
  EffectFade,
  Autoplay,
  Thumbs,
  Controller,
  FreeMode,
]);

export default class WooGallery {
  constructor() {
    this.galleryTop = document.querySelectorAll(".gallery-slider");
    this.galleryThumbs = document.querySelectorAll(".gallery-thumbs");
    this.sliderTop = null;
  }

  init() {
    if (!this.galleryTop) {
      return false;
    }
    this.createGallery();
  }

  createGallery() {
    if (this.galleryThumbs.length > 0) {
      let sliderThumbs = new Swiper(".gallery-thumbs", {
        slidesPerView: 2,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
          760: {
            slidesPerView: 4,
          },
        },
        navigation: {
          nextEl: ".swiper-arrow-right",
          prevEl: ".swiper-arrow-left",
        },

      });
      const sliderTop = new Swiper(".gallery-slider", {
        slidesPerView: 1,
        speed: 1500,
        loop: true,
        autoHeight: false,
        // autoplay: {
        //   delay: 3000,
        // },
        thumbs: {
          swiper: sliderThumbs,
        },
        breakpoints: {
          780: {
            // autoplay: { delay: 3000 },
          },
        },
      });
      const prevBtn = document.querySelector('.swiper-arrow-left');
      const nextBtn = document.querySelector('.swiper-arrow-right');

      if (prevBtn != null) {
          prevBtn.addEventListener('click', () => {
              sliderTop.slidePrev();
              sliderThumbs.slidePrev();
          }, false);
      }

      if (nextBtn != null) {
          nextBtn.addEventListener('click', () => {
              sliderTop.slideNext();
              sliderThumbs.slideNext();
          }, false);
      }
    } else {
      this.sliderTop = new Swiper(".gallery-slider", {
        slidesPerView: 1,
        speed: 1500,
        loop: false,
        autoHeight: false,
      });
    }
  }
}