import $ from "jquery";

require('./bootstrap');
import Swiper from 'swiper/bundle';
import 'swiper/css';
import 'swiper/css/bundle';
import WOW from 'wow.js'
import Search from "./search";

const wow = new WOW(
    {
        boxClass: 'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 100,          // distance to the element when triggering the animation (default is 0)
        duration: .5,
        mobile: true,       // trigger animations on mobile devices (default is true)
        live: true,       // act on asynchronously loaded content (default is true)
        callback: function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null,    // optional scroll container selector, otherwise use window,
        resetAnimation: true,     // reset animation on end (default is true)
    }
);

// rotate logo to directed location of user position vertically
window.addEventListener('mousemove', (event) => {
    // Calculate rotation angle based on vertical mouse position
    const svgElement = document.querySelector('#svg-link');
    let rotationAngle = 0;
    const windowHeight = window.innerHeight;
    const verticalMousePos = event.clientY;
    const maxRotationAngle = 120; // maximum rotation angle in degrees
    rotationAngle = (verticalMousePos / windowHeight - 0.5) * maxRotationAngle;

    // Apply rotation to SVG element
    svgElement.style.transform = `rotate(${rotationAngle}deg)`;
});


wow.init();
$(document).ready(function () {
        //mouse courser
        var cursor = $(".cursor");
        $(window).mousemove(function (e) {
            cursor.css({
                top: e.clientY - cursor.height() / 2,
                left: e.clientX - cursor.width() / 2
            });
        });
        $(window)
            .mouseleave(function () {
                cursor.css({opacity: "0"});
            })
            .mouseenter(function () {
                cursor.css({opacity: "1"});
            });
        //Spotlight on any number of elements by just selecting them
        $(".sub_head")
            .mouseenter(function () {
                cursor.css({transform: "scale(3.2)"});
            })
            .mouseleave(function () {
                cursor.css({transform: "scale(1)"});
            });
        $(window)
            .mousedown(function () {
                cursor.css({transform: "scale(.2)"});
            })
            .mouseup(function () {
                cursor.css({transform: "scale(1)"});
            });
        $(window).scroll(function () { // check if scroll event happened
            if ($(document).scrollTop() > 30) { // check if user scrolled more than 50 from top of the browser window
                $('.backTo_Top').removeClass('outro');
            } else {
                $('.backTo_Top').addClass('outro');
            }
        })
    }
);

document.addEventListener('DOMContentLoaded', function () {
    const search = new Search();
    //toggle header on time
    const toggleScrollClass = function () {
        if (window.scrollY > 24) {
            document.body.classList.add('scrolled');
        } else {
            document.body.classList.remove('scrolled');
        }
    }

    toggleScrollClass();

    //check scroll to take actions on it
    window.addEventListener('scroll', function () {
        toggleScrollClass();
    });

// Initialize Swiper
    let swiper1 = new Swiper('.hero-swiper', {
        direction: 'horizontal',
        loop: true,
        effect: 'slide',
        speed: 1000,
        slidesPerView: 3.2,
        spaceBetween: 0,
        mousewheel: true,
        breakpoints: {
            992: {
                centeredSlides: true,
                slidesPerView: 4.1,
            }
        }
    });
    // Initialize Swiper
    let swiper2 = new Swiper('.page-swiper', {
        direction: 'horizontal',
        loop: false,
        effect: 'slide',
        autoplay: {
            delay: 5000,
            stopOnLastSlide: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        speed: 1000,
        spaceBetween: 5,
        slidesPerView: 1.05,
        mousewheel: true,
        breakpoints: {
            992: {
                slidesPerView: 2.7,
                spaceBetween: 30,
            }
        }
    });

    const slides = document.querySelectorAll('.swiper-slide');
    const background = document.querySelector('.full-screen-section');
    const main_title = document.querySelector('.main-title');
    const main_excerpt = document.querySelector('.main-excerpt');
    const main_button = document.querySelector('.main-bottom');
    const slide_index = document.querySelector('.slide-index');

// Set initial background image from first slide
    const firstSlide = slides[0];
    const firstImageURL = firstSlide.getAttribute('data-image');
    background.style.backgroundImage = `url(${firstImageURL})`;

// Set initial slide info from first slide
    const firstSlideIndex = firstSlide.getAttribute('data-swiper-slide-index');
    const firstSlideTitle = firstSlide.getAttribute('data-title');
    const firstSlideExcerpt = firstSlide.getAttribute('data-excerpt');
    const firstSlidePermalink = firstSlide.getAttribute('data-url');
    main_title.textContent = firstSlideTitle;
    slide_index.textContent = Number(firstSlideIndex) + 1;
    main_excerpt.textContent = firstSlideExcerpt;
    main_button.setAttribute('href', firstSlidePermalink);

// Change background image and slide info on slide hover
    slides.forEach(slide => {
        const imageURL = slide.getAttribute('data-image');
        const slideIndex = slide.getAttribute('data-swiper-slide-index');
        const excerpt_data = slide.getAttribute('data-excerpt');
        const permalink_data = slide.getAttribute('data-url');
        const title_data = slide.getAttribute('data-title');

        slide.addEventListener('mouseenter', () => {
            // background.style.opacity = 0;
            $('.full-screen-section').fadeOut();
            setTimeout(() => {
                slide_index.textContent = Number(slideIndex) + 1;
                main_title.textContent = title_data;
                main_excerpt.textContent = excerpt_data;
                main_button.setAttribute('href', permalink_data);
                $('.full-screen-section').fadeIn();
                background.style.backgroundImage = `url(${imageURL})`;
                // background.style.opacity = 1;
            }, 300);

        });
    });
})

// animation for menu
function openNav() {
    document.getElementById("sideNavigation").style.marginLeft = "0";
    document.getElementById("main").style.marginLeft = "250px";
    document.querySelector('.topNav').classList.add("open-nav");
    document.getElementById("svg-link").classList.add("clicked");
    document.getElementById("svg-link-mob").classList.add("clicked");
}

function closeNav() {
    document.getElementById("sideNavigation").style.marginLeft = "-300px";
    document.getElementById("main").style.marginLeft = "0";
    document.querySelector('.topNav').classList.remove("open-nav");
    document.getElementById("svg-link").classList.remove("clicked");
    document.getElementById("svg-link-mob").classList.remove("clicked");
}

document.addEventListener('DOMContentLoaded', function () {
    const topNav = document.querySelector('.topNav');

    function toggleNav() {
        if (topNav.classList.contains('open-nav')) {
            closeNav();
            topNav.removeEventListener("click", toggleNav);
            topNav.addEventListener("click", toggleNav);
        } else {
            openNav();
            topNav.removeEventListener("click", toggleNav);
            topNav.addEventListener("click", toggleNav);
        }
    }

    topNav.addEventListener("click", toggleNav, { passive: true });
    document.querySelector('.topNav-mob').addEventListener("click", toggleNav, { passive: true });
    document.querySelector('.closeBtn').addEventListener("click", closeNav, { passive: true });
    document.getElementById('main').addEventListener("click", closeNav, { passive: true });
});


