import Swiper from 'swiper/bundle';
// import Swiper and modules styles
import 'swiper/css/bundle';

const slider = document.querySelector('.reviews__slider');

const reviews = new Swiper(slider, {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 1,
    loop: true,
    coverflowEffect: {
        depth: 100,
        modifier: 1,
        rotate: 50,
        scale: 1,
        slideShadows: true,
        stretch: 0
    },
    breakpoints: {
        580: {
            slidesPerView: 2,
        },
        960: {
            slidesPerView: 3
        }
    },

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
})