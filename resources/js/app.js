require('./bootstrap');

class App {
    constructor() {
        this.mobileNav();
    }
}

App.prototype.mobileNav = function() {
    let hamburgerButton = document.querySelector('.hamburger-icon');
    let mobileNav = document.querySelector('.mobile-nav');

    hamburgerButton.addEventListener('click', function() {
        mobileNav.classList.toggle('open');
    });

};
new App();
