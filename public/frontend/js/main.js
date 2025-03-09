// theme
const btnDark = document.querySelector('.btn-dark');
const btnLight = document.querySelector('.btn-light');
const html = document.querySelector('html');
const main = document.getElementById('main');
var loader = document.getElementById('loaders');

window.addEventListener(
	'load',
	function () {
		let theme = this.localStorage.getItem('data-theme');
		loader.style.display = 'none';

		if ((loader.style.display = 'none')) {
			if (localStorage.getItem('data-theme') === 'dark') {
				console.log(localStorage.getItem('data-theme'));
				html.classList.add('dark');
				html.classList.remove('light');
				main.style.display = 'block';
			} else if(localStorage.getItem('data-theme') === 'light'){
				html.classList.remove('dark');
				html.classList.add('light');
				main.style.display = 'block';
			}else{
				html.classList.add('dark');
				html.classList.remove('light');
				main.style.display = 'block';
			}
		}
	},
	false
);

btnDark.addEventListener('click', () => {
	html.classList.remove('light');
	html.classList.add('dark');
	localStorage.setItem('data-theme', 'dark');
});

btnLight.addEventListener('click', () => {
	html.classList.remove('dark');
	html.classList.add('light');
	localStorage.setItem('data-theme', 'light');
});

// shop pgae sidebar
const closeCategoryBtn = document.querySelector('.btn-close-categories');
const openCategoryBtn = document.querySelector('.btn-category');
const shop = document.querySelector('.shop');

if (shop) {
	closeCategoryBtn.addEventListener('click', () => {
		shop.classList.remove('show-category');
	});
	openCategoryBtn.addEventListener('click', () => {
		shop.classList.add('show-category');
	});
}

// swiper carousel
const swiper = new Swiper('.swiper', {
	// Optional parameters
	loop: true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},
});

// jquery document ready

$(document).ready(function () {
	// meanmenu
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: '992',
	});

	// MOBILE MENU CLICKABLE
	$('.open-mobile-menu').on('click', function () {
		$('.mobile_info_open').addClass('show');
		$('.offcanvas-overlay').addClass('overlay-open');
	});

	$(
		'.close_info,.offcanvas-overlay,.mobile_one_page li.menu-item a.nav-link'
	).on('click', function () {
		$('.mobile_info_open').removeClass('show');
		$('.offcanvas-overlay').removeClass('overlay-open');
	});

	// add header sticky
	$(window).on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 245) {
			$('.header-sticky').removeClass('sticky');
		} else {
			$('.header-sticky').addClass('sticky');
		}
	});

	// MOBILE MENU CLICKABLE
	$('.login').on('click', function () {
		$('.popup__login').addClass('block');
		$('body').addClass('overflow-h');
		$('.offcanvas-overlay').addClass('overlay-open');
	});

	$('.register').on('click', function () {
		$('.popup__register').addClass('block');
		$('.offcanvas-overlay').addClass('overlay-open');
	});

	$('.openacount').on('click', function () {
		$('.popup__register').addClass('block');
		$('.offcanvas-overlay').addClass('overlay-open');
	});

	$('.popup__icon,.offcanvas-overlay').on('click', function () {
		$('.popup__login').removeClass('block');
		$('.popup__register').removeClass('block');
		$('.offcanvas-overlay').removeClass('overlay-open');
	});

	$('.nav__item').on('click', function () {
		$('.nav__dropdown').toggleClass('block');
	});
});

// dashboard hide show
var dashboard = document.querySelector('.dashboard__main');
var dashboardicon = document.querySelector('.dashboard-open');
if (dashboard && dashboardicon) {
	dashboardicon.addEventListener('click', () => {
		dashboard.classList.toggle('block');
	});
}

const mean_nav = document.getElementsByClassName('mean-nav');
 

$('.ms_has-submenu > a').click(function (e) {
	e.preventDefault();
	$(this).parent().toggleClass('ms_active');
	$(this).next('.ms_submenu').slideToggle(200);
	$(this)
		.parent()
		.siblings()
		.removeClass('ms_active')
		.children('.ms_submenu')
		.slideUp(200);
});
// const element = document.getElementById("mobile_menu_wrap");
// let numb = element.childNodes.length;
// console.log(numb)
// mobile_menu.addEventListener('click',(e)=>{
// 	console.log(mobile_menu.childNodes)
// })