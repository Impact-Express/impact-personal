require('./bootstrap');

class App {
    constructor() {
        this.mobileNav();
    }
}

App.prototype.mobileNav = function() {
    let hamburgerButton = document.querySelector('.hamburger-icon');
    let mobileNav = document.querySelector('.mobile-nav');
    let html = document.querySelector('body');

    function openMobile() {
        mobileNav.classList.add('open');
    }

    function closeMobile() {
        mobileNav.classList.remove('open');
    }

    hamburgerButton.addEventListener('click', openMobile);
    mobileNav.addEventListener('click', closeMobile);
};
new App();
