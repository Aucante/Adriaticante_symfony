import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        var texte = document.getElementById("texte");
        texte.setAttribute("style", "color:blue");
    }
}