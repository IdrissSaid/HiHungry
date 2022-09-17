export function ScrollEvent() {
    let headerHeight = document.getElementById('header').clientHeight;

    if (window.scrollY >= 150 && headerHeight >= 60) {
        document.getElementById('header').style.height = (headerHeight - 5).toString() + 'px';
    } else if (window.scrollY < 150 && headerHeight < 100) {
        document.getElementById('header').style.height = (headerHeight + 5).toString() + 'px';
    }
}
