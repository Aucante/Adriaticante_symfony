import { Controller } from '@hotwired/stimulus';


export default class extends Controller {
    connect() {
        var cities = {
            "Tivat": { "latitude": 42.431852, "longitude": 18.70714 },
            "Brest": { "latitude": 48.383, "longitude": -4.500 },
            "Quimper": { "latitude": 48.000, "longitude": -4.100 },
            "Bayonne": { "latitude": 43.500, "longitude": -1.467 }
        };
        // Card initialization
        var map = L.map('map').setView([42.431852, 18.70714], 13);
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
        for(var city in cities)
        {
            var circle = L.circle([cities[city].latitude, cities[city].longitude], {
                color: '#263238',
                fillColor: '#263238',
                fillOpacity: 0.5,
                radius: 3000
            }).addTo(map);
        }
    }
}
