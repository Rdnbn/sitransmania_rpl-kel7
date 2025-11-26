// ==============================
// CONFIG FIREBASE
// ==============================
const firebaseConfig = {
    apiKey: "ISI_SENDIRI",
    authDomain: "ISI_SENDIRI",
    databaseURL: "ISI_SENDIRI",
    projectId: "ISI_SENDIRI",
    storageBucket: "ISI_SENDIRI",
    messagingSenderId: "ISI_SENDIRI",
    appId: "ISI_SENDIRI",
};

// Inisialisasi Firebase
firebase.initializeApp(firebaseConfig);

// Path data lokasi di Firebase
const lokasiRef = firebase.database().ref("lokasi_kendaraan");

// ==============================
// KONFIGURASI LEAFLET
// ==============================
var map = L.map("map").setView([-6.982, 110.409], 14); // default Semarang

// Tile OpenStreetMap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
}).addTo(map);

// Marker awal
var marker = L.marker([-6.982, 110.409]).addTo(map);
marker.bindPopup("Menunggu data...");

// ==============================
// LISTEN DATA REALTIME FIREBASE
// ==============================
lokasiRef.on("value", (snapshot) => {
    const data = snapshot.val();

    if (!data) return;

    const lat = data.lat;
    const lng = data.lng;

    // Update posisi marker
    marker.setLatLng([lat, lng]);
    marker.bindPopup("Lokasi saat ini:<br>Lat: " + lat + "<br>Lng: " + lng);

    // Gerakkan map mengikuti marker
    map.setView([lat, lng]);
});
