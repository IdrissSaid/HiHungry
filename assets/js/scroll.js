const home = document.getElementById('home');
const swipe = document.getElementById('swipe');

export function scroll() {
    if (window.scrollY > 20) {
        home.classList.add('scroll');
        swipe.innerHTML = 'Restaurants';
        swipe.style.margin = '10px';
    }
}