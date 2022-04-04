import { Controller } from '@hotwired/stimulus';
import NiceSelect from "nice-select2/dist/js/nice-select2";
import "nice-select2/dist/css/nice-select2.css";

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        new NiceSelect(this.element, {searchable: true});
    }
}