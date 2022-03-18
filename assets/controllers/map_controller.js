import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    connect() {
        var city = { "latitude": this.element.dataset.latitude, "longitude": this.element.dataset.longitude }
        // Card initialization
        var map = L.map('map').setView([this.element.dataset.latitude, this.element.dataset.longitude], 13);
        // Tile loaded
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 10,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYWRyaWF0aWNhbnRlLXRlc3QiLCJhIjoiY2wwb2F5aDA4MGZ0YTNqcGtld3g4MzMxdyJ9.s6pkqD-kP_D62ukhRhmU5w'
        }).addTo(map);
        // Marker
            var circle = L.circle([city.latitude, city.longitude], {
                color: '#263238',
                fillColor: '#263238',
                fillOpacity: 0.5,
                radius: 3000
            }).addTo(map);
    }
}
