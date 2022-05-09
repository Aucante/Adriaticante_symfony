import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    userCookie;
    userCookieEssentials;
    connect() {
        this.userCookie = localStorage.getItem('userCookie');
        this.userCookieEssentials = localStorage.getItem('userCookieEssentials');
        if (this.userCookie !== '1' || this.userCookieEssentials !== '1') {
            this.element.classList.remove('d-none');
        }
    }
    accept() {
        localStorage.setItem('userCookie', '1');
        this.element.remove();
    }
    acceptEssentials() {
        localStorage.setItem('userCookieEssentials', '1');
        this.element.remove();
    }
}