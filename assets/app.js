/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

const header = document.querySelector('header');
window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
        header.classList.add('sticky');
    }
   else {
        header.classList.remove('sticky');
    }
})

const infoBadges = document.querySelectorAll('span.info');
window.addEventListener('scroll', () => {
    infoBadges.forEach(el => {
        el.classList.add('bounce');
    })
})

// mobile menu
const burger = document.querySelector('.burger');
burger.addEventListener('click', () => {
    document.querySelector('header.header').classList.toggle('mobile-nav');
})