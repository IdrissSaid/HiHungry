import { scroll } from "./scroll.js";
import { setList } from './menu.js';

window.addEventListener("DOMContentLoaded", (event) => {
    console.log("DOM entièrement chargé et analysé");
    document.addEventListener('scroll', () => {
        scroll();
    });
    document.getElementsByClassName('card 1')[0].addEventListener('click', (e) => {
        setList('La Cayenne');
        closeAnimationRestaurant();
        openMenu();
    });
    document.getElementsByClassName('head')[0].addEventListener('click', (e) => {
        if (document.getElementsByClassName('card')[0].style.display == 'none') {
            openAnimationRestaurant();
            removeMenu();
        }
    });
});

function removeMenu() {
    let carte = document.getElementsByClassName('carte')[0];
    document.getElementsByClassName('title_menu')[0].remove();
    let uls = carte.getElementsByTagName('ul');
    let size = uls.length;

    for (let i = size - 1; i >= 0; i--)
        uls[i].remove();
    document.getElementsByClassName('articles menu')[0].style.display = 'none';
}

function closeAnimationRestaurant() {
    let cards = document.getElementsByClassName('card');

    for (let i = 0; cards[i]; i++) {
        cards[i].style.display = 'none';
    }
    document.getElementsByClassName('fa fa-caret-down')[0].style.display = 'inline-block';
}

function openAnimationRestaurant() {
    let cards = document.getElementsByClassName('card');

    for (let i = 0; cards[i]; i++) {
        cards[i].style.display = 'inline-block';
    }
    document.getElementsByClassName('fa fa-caret-down')[0].style.display = 'none';
}

function openMenu() {
    document.getElementsByClassName('articles menu')[0].style.display = "block";
}
