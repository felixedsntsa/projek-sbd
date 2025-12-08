@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="container mx-auto p-4">

    <div class="bg-white shadow-md p-4 rounded-lg mb-4">
        <h2 class="text-xl font-semibold mb-3">Pengaturan Lokasi & Filter</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-semibold">Kategori</label>
                <select id="filterCategory" class="w-full border px-3 py-2 rounded">
                    <option value="all">Semua</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->name }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Latitude Lokasi Anda</label>
                <input type="text" id="latInput"
                       value="{{ session('user_lat') ?? '' }}"
                       class="w-full border px-3 py-2 rounded"
                       placeholder="Isi latitude Anda">
            </div>

            <div>
                <label class="font-semibold">Longitude Lokasi Anda</label>
                <input type="text" id="lngInput"
                       value="{{ session('user_lng') ?? '' }}"
                       class="w-full border px-3 py-2 rounded"
                       placeholder="Isi longitude Anda">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="font-semibold">Radius (km)</label>
                <select id="filterRadius" class="w-full border px-3 py-2 rounded">
                    <option value="0">Tanpa radius</option>
                    <option value="1">1 km</option>
                    <option value="2" selected>2 km</option>
                    <option value="3">3 km</option>
                </select>
            </div>
        </div>

        <div class="flex gap-3 mt-4">
            <button onclick="focusUserLocation()"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Gunakan Lokasi Saya
            </button>

            <button onclick="setLocationFromInput()"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Input Manual dan Apply Filter
            </button>
        </div>
    </div>

    <div id="map" class="w-full h-[500px] rounded-lg shadow-lg"></div>

    <div class="mt-4">
        <h2 class="text-xl font-bold mb-3">Daftar UMKM Terdekat</h2>
        <div id="umkmList" class="space-y-3 max-h-80 overflow-y-auto pr-2"></div>
    </div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-8.164987, 113.713421], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let userMarker = null;
    let radiusCircle = null;

    function updateInputs(lat, lng) {
        document.getElementById("latInput").value = lat;
        document.getElementById("lngInput").value = lng;
    }

    function drawRadius(lat, lng, km) {
        if (radiusCircle) map.removeLayer(radiusCircle);

        if (km > 0) {
            radiusCircle = L.circle([lat, lng], {
                radius: km * 1000,
                color: "red",
                fillColor: "#ffcccc",
                fillOpacity: 0.3
            }).addTo(map);
        }
    }

    function setUserMarker(lat, lng) {
        if (userMarker) map.removeLayer(userMarker);

        userMarker = L.marker([lat, lng], {
            draggable: true,
            icon: L.icon({
                iconUrl: "/image/icons/user_icon.png",
                iconSize: [35, 35],
                iconAnchor: [17, 34]
            })
        }).addTo(map);

        userMarker.bindPopup("<b>Lokasi Anda</b>").openPopup();

        userMarker.on("dragend", function (e) {
            const pos = e.target.getLatLng();
            updateInputs(pos.lat, pos.lng);
            applyFilters();
        });

        updateInputs(lat, lng);
        applyFilters();
    }

    // Auto detect location
    map.locate({ setView: true, maxZoom: 17, enableHighAccuracy: true });

    map.on("locationfound", e => setUserMarker(e.latitude, e.longitude));
    map.on("locationerror", () => console.warn("Geolocation gagal."));

    function setLocationFromInput() {
        let lat = parseFloat(document.getElementById("latInput").value);
        let lng = parseFloat(document.getElementById("lngInput").value);

        if (isNaN(lat) || isNaN(lng)) {
            alert("Latitude/Longitude tidak valid");
            return;
        }

        setUserMarker(lat, lng);
        map.setView([lat, lng], 17);
    }

    let markers = [];
    const umkmData = @json($umkm);

    umkmData.forEach(item => {

        const iconPath = item.category_icon
            ? `/image/icons/${item.category_icon}`
            : `/image/icons/default.png`;

        const customIcon = L.icon({
            iconUrl: iconPath,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
        });

        let marker = L.marker([item.lat, item.lng], { icon: customIcon });

        marker.bindPopup(`
            <div class="font-semibold text-lg mb-2">${item.name}</div>
            <img src="/image/umkm/${item.image ?? 'no_image.jpg'}"
                class="w-full h-28 object-cover rounded mb-2">
            <div><strong>Kategori:</strong> ${item.category_name ?? '-'}</div>
            <div><strong>Alamat:</strong> ${item.address ?? '-'}</div>
            <div><strong>Telepon:</strong> ${item.phone ?? '-'}</div>
            <div><strong>Jam Operasional:</strong> ${item.opening_hours ?? '-'}</div>
        `);

        markers.push({
            id: item.id,
            lat: item.lat,
            lng: item.lng,
            category: item.category_name,
            marker: marker
        });

        marker.addTo(map);
    });

    function getDistance(lat1, lng1, lat2, lng2) {
        const R = 6371;
        let dLat = (lat2 - lat1) * Math.PI / 180;
        let dLng = (lng2 - lng1) * Math.PI / 180;

        let a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) *
            Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLng / 2) * Math.sin(dLng / 2);

        return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
    }

    function applyFilters() {
        let selectedCategory = document.getElementById("filterCategory").value;
        let selectedRadius = parseFloat(document.getElementById("filterRadius").value);

        markers.forEach(item => map.removeLayer(item.marker));

        let lat = parseFloat(document.getElementById("latInput").value);
        let lng = parseFloat(document.getElementById("lngInput").value);

        drawRadius(lat, lng, selectedRadius);

        markers.forEach(item => {
            let show = true;

            if (selectedCategory !== "all" && item.category !== selectedCategory) {
                show = false;
            }

            if (selectedRadius > 0 && userMarker) {
                let userPos = userMarker.getLatLng();
                let distance = getDistance(userPos.lat, userPos.lng, item.lat, item.lng);

                if (distance > selectedRadius) show = false;
            }

            if (show) item.marker.addTo(map);
        });
    }

    const umkmListContainer = document.getElementById("umkmList");

    function updateUmkmList() {
        if (!userMarker) {
            umkmListContainer.innerHTML = "<p class='text-gray-500'>Lokasi belum ditemukan...</p>";
            return;
        }

        let selectedCategory = document.getElementById("filterCategory").value;
        let selectedRadius = parseFloat(document.getElementById("filterRadius").value);

        let userPos = userMarker.getLatLng();

        // Hitung ulang jarak setiap UMKM
        let nearby = markers
            .map(item => {
                let distance = getDistance(userPos.lat, userPos.lng, item.lat, item.lng);

                return {
                    ...item,
                    distance: distance
                };
            })
            .filter(item => {
                // Filter kategori
                if (selectedCategory !== "all" && item.category !== selectedCategory) {
                    return false;
                }

                // Filter radius
                if (selectedRadius > 0 && item.distance > selectedRadius) {
                    return false;
                }

                return true;
            })
            .sort((a, b) => a.distance - b.distance); // urut terdekat

        // Render card
        if (nearby.length === 0) {
            umkmListContainer.innerHTML =
                `<p class="text-gray-500">Tidak ada UMKM pada radius ini.</p>`;
            return;
        }

        umkmListContainer.innerHTML = nearby
            .map(item => `
                <div onclick="focusMarker(${item.id})"
                    class="p-3 border rounded-lg hover:bg-gray-100 cursor-pointer transition">

                    <div class="flex items-center gap-3">
                        <img src="/image/icons/${item.category_icon ?? 'default.png'}"
                            class="w-10 h-10 rounded object-contain">

                        <div>
                            <div class="font-semibold">${item.marker.options.title ?? item.category}</div>
                            <div class="text-sm text-gray-600">${item.distance.toFixed(2)} km</div>
                        </div>
                    </div>

                    <div class="mt-2 text-sm">
                        <span class="font-medium">${item.category}</span>
                    </div>
                </div>
            `)
            .join("");
    }

    function focusUserLocation() {
        if (!userMarker) return alert("Lokasi belum tersedia");
        map.setView(userMarker.getLatLng(), 18);
        userMarker.openPopup();
    }

</script>

@endsection
