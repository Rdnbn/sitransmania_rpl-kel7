@extends('layouts.app')

@section('title', 'Live Map')

@section('content')

<h3 class="fw-bold mb-3">Live Map • {{ $kendaraan->tipe }} ({{ $kendaraan->plat_nomor }})</h3>

<div id="map" style="height: 70vh; border-radius:10px;" class="shadow"></div>

@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-7.981298, 112.626495], 15); // pusat UM

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    let marker = null;
    const idKendaraan = {{ $kendaraan->id_kendaraan }};

    function fetchLocation() {
        fetch(`/live-map/data/${idKendaraan}`)
            .then(res => res.json())
            .then(data => {
                if (!data) return;

                const lat = parseFloat(data.latitude);
                const lng = parseFloat(data.longitude);

                if (!marker) {
                    marker = L.marker([lat, lng]).addTo(map);
                } else {
                    marker.setLatLng([lat, lng]);
                }

                map.setView([lat, lng]);
            });
    }

    setInterval(fetchLocation, 2000);
    fetchLocation();
</script>
@endsection
