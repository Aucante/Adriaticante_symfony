import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    userCookie;
    connect() {
        this.userCookie = localStorage.getItem('userCookie');
        if (this.userCookie !== '1') {
            this.element.classList.remove('d-none');
        }
    }
    accept() {
        localStorage.setItem('userCookie', '1');
        this.element.remove();
    }
}