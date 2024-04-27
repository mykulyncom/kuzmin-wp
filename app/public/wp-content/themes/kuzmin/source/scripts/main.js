import './sliders.js';
// import './navigation.js';
// import './accordion.js';
// import './forms.js';
// import './modals.js';
import '../../node_modules/page-scroll-to-id/jquery.malihu.PageScroll2id';

import '../lib/magnific/jquery.magnific-popup';

$(document).ready(function () {

	const headerHeight = $(".header").height();

	const mLinks = document.querySelectorAll('.menu__link');
	mLinks.forEach(function (item) {
		item.addEventListener('click', function (e) {
			e.preventDefault();
			document.querySelector('.header__burger').classList.remove('header__burger--active');
			document.querySelector('.menu').classList.remove('menu--active');
		});

	});

	$("a.menu__link").mPageScroll2id({
		offset: headerHeight,
		scrollSpeed: 500,
		autoScrollSpeed: false,
		layout: 'vertical',
		pageEndSmoothScroll: false,
		scrollEasing: 'linear',
		scrollingEasing: 'linear'
	});

	// $('a[href*="#"]').on('click', function (e) {
	// 	e.preventDefault();
	//
	// 	$('html, body').animate({
	// 		scrollTop: $($(this).attr('href')).offset().top
	// 	}, 500, 'linear');
	// });

	// $("a.menu__link").on("click", function (e) {
	// 	// 1
	// 	e.preventDefault();
	// 	// 2
	// 	const href = $(this).attr("href");
	// 	console.log(href);
	// 	// 3
	// 	$("html, body").animate({ scrollTop: $(href).offset().top }, 800);
	// });


	$(".accordion-title").parent().first().addClass("accordion-item--open");
// $(".accordion-title").parent().first().siblings(".accordion-content").slideUp(200);
	$(".accordion-title").on("click", function () {
		if ($(this).parent().hasClass("accordion-item--open")) {
			$(this).parent().removeClass("accordion-item--open");
			$(this).siblings(".accordion-content").slideUp(200);
		} else {
			$(".accordion-title").parent().removeClass("accordion-item--open");
			$(this).parent().addClass("accordion-item--open");
			$(".accordion-content").slideUp(200);
			$(this).siblings(".accordion-content").slideDown(200);
		}
	});

	$('.popup-youtube').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		},

		fixedContentPos: false
	});
	$('#wpcf7-f192-p2-o1 .mwf-button').text('Проконсультироваться');

	const scrollBegin = $(".hero").height();
	//
	// $(".header").removeClass("header--up");


	// $(window).scroll(function () {
	// 	const top = $(this).scrollTop();
	// 	if (top > headerHeight) {
	// 		$(".header").addClass("header--down");
	// 	} else {
	// 		$(".header").removeClass("header--down");
	// 	}
	//
	// 	if (top > scrollBegin) {
	// 		$(".header").addClass("is-fixed");
	// 	} else if (top < scrollBegin) {
	// 		$(".header").removeClass("is-fixed");
	// 	}
	// });

	$(window).scroll(function () {
		const top = $(this).scrollTop();
		// if (top > headerHeight) {
		// 	$(".header").addClass("header--down");
		// } else {
		// 	$(".header").removeClass("header--down");
		// }

		if (top > scrollBegin) {
			$(".header").addClass("is-fixed");
		} else if (top < scrollBegin) {
			$(".header").removeClass("is-fixed");
		}
	});

	$('.open-popup').magnificPopup({
		type: 'inline',
		preloader: false,
	});


});


const btnHam = document.querySelectorAll('.header__burger');
const menu = document.querySelector('.menu');

btnHam.forEach(function (item) {
	item.addEventListener('click', function () {
		this.classList.toggle('header__burger--active');
		menu.classList.toggle('menu--active');
	});
});