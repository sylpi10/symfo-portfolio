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
// const infosArray = [...infoBadges].map(info => info);
window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        infoBadges.forEach(el => {
            el.classList.add('bounce');
      })
    }else{
        infoBadges.forEach(el => {
            el.classList.remove('bounce');
        })
    }
})