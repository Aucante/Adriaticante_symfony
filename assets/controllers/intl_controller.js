import { Controller } from '@hotwired/stimulus';
import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/build/css/intlTelInput.css';

export default class extends Controller {
    static targets = [ "input" ];
    connect() {
        intlTelInput(this.inputTarget, {
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                return "e.g. " + selectedCountryPlaceholder;
            },
            nationalMode: false,
            preferredCountries: ['it', 'hr', 'si', 'me', 'gb', 'fr', 'de', 'ch', 'es', 'pt', 'nl', 'dk', 'no', 'se', 'fi', 'be', 'rs', 'ca' , 'us'],
            separateDialCode: true
        });
    }
}