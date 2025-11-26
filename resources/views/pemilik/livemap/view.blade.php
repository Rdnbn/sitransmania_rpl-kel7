@extends('layouts.app')

@section('title', 'Live Map')

@section('content')

<h3 class="fw-bold mb-3">
    Live Location: {{ $kendaraan->tipe }} ({{ $kendaraan->plat_nomor }})
</h3>

<div id="map" style="height: 450px; border-radius: 10px;"></div>

{{-- Leaflet.js --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([-7.9553, 112.613], 14);
    var marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    function loadLocation() {
        fetch("/api/location/{{ $kendaraan->id_kendaraan }}")
        .then(r => r.json())
        .then(data => {
            if (!data) return;

            var lat = data.latitude;
            var lon = data.longitude;

            if (!marker) {
                marker = L.marker([lat, lon]).addTo(map);
            } else {
                marker.setLatLng([lat, lon]);
            }

            map.setView([lat, lon]);
        });
    }

    loadLocation();
    setInterval(loadLocation, 5000); // update setiap 5 detik
</script>

@endsection
