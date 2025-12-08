@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-700 text-white shadow-xl">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-6 md:mb-0 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">
                    <span class="text-white">Print</span>
                    <span class="text-cyan-300">Spot</span>
                </h1>
                <p class="text-blue-100 text-sm md:text-base max-w-2xl">
                    Temukan berbagai UMKM fotocopy dan printing terdekat dengan solusi cepat, mudah, dan profesional dalam genggaman Anda.
                </p>
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex flex-col items-end">
                    <span class="font-medium">{{ auth()->user()->name }}</span>
                    <span class="text-sm text-blue-200">{{ auth()->user()->email }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit"
                            class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="hidden md:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="container mx-auto p-4 pt-6">

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

        <div class="flex flex-wrap gap-3 mt-4">
            <button onclick="focusUserLocation()"
                class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full transition-all duration-200 shadow hover:shadow-lg hover:scale-[1.02]">
                <i class="bi bi-geo-alt-fill"></i>
                Lokasi Saya
            </button>
            <button onclick="setLocationFromInput()"
                class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-full transition-all duration-200 shadow hover:shadow-lg hover:scale-[1.02]">
                <i class="bi bi-pencil-square"></i>
                Input Manual
            </button>
            <a href="{{ route('profile') }}"
                class="flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-full transition-all duration-200 shadow hover:shadow-lg hover:scale-[1.02]">
                <i class="bi bi-person-circle text-white"></i>
                Profile
            </a>
        </div>
    </div>

    <div id="map" class="w-full h-[500px] rounded-lg shadow-lg"></div>

    <div class="mt-4">
        <h2 class="text-xl font-bold mb-3">Daftar UMKM Terdekat</h2>
        <div id="umkmList" class="space-y-3 max-h-[600px] overflow-y-auto pr-2"></div>
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
                color: "#10B981",      // Emerald green
                fillColor: "#34D399",  // Emerald light
                fillOpacity: 0.15,
                weight: 2,             // Ketebalan garis
                dashArray: "10, 10",   // Garis putus-putus
                opacity: 0.8           // Opacity garis
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

        // Build services list HTML
        let servicesHtml = '';
        if (item.services && item.services.length > 0) {
            servicesHtml = '<div class="mt-2"><strong>Fasilitas Tersedia:</strong><ul class="list-disc ml-4">';
            item.services.forEach(service => {
                servicesHtml += `<li>${service.name}</li>`;
            });
            servicesHtml += '</ul></div>';
        }

        marker.bindPopup(`
            <div class="font-semibold text-lg mb-2">${item.name}</div>
            <img src="/image/umkm/${item.image ?? 'no_image.jpg'}"
                class="w-full h-28 object-cover rounded mb-2">
            <div><strong>Kategori:</strong> ${item.category_name ?? '-'}</div>
            <div><strong>Alamat:</strong> ${item.address ?? '-'}</div>
            <div><strong>Telepon:</strong> ${item.phone ?? '-'}</div>
            <div><strong>Jam Operasional:</strong> ${item.opening_hours ?? '-'}</div>
            ${servicesHtml}
        `);

        markers.push({
            id: item.id,
            name: item.name,
            address: item.address,
            phone: item.phone,
            opening_hours: item.opening_hours,
            image: item.image,
            lat: item.lat,
            lng: item.lng,
            category: item.category_name,
            category_icon: item.category_icon,
            services: item.services || [],
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

        // Update list after filter
        updateUmkmList();
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
            .map((item, index) => {
                // Build services checklist
                let servicesHtml = '';
                if (item.services && item.services.length > 0) {
                    servicesHtml = item.services.map(service => `
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm">${service.name}</span>
                        </div>
                    `).join('');
                }

                return `
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-4">
                            <!-- Header Card -->
                            <div class="flex items-start gap-3 mb-3">
                                <div class="flex-shrink-0 bg-blue-50 rounded-full p-2">
                                    <span class="text-2xl font-bold text-blue-600">${index + 1}</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg text-gray-800">${item.name}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        ${item.category_icon ?
                                            `<img src="/image/icons/${item.category_icon}" class="w-5 h-5">` :
                                            ''}
                                        <span class="text-sm text-gray-600">${item.category}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-sm font-semibold text-blue-600">${item.distance.toFixed(2)} km</span>
                                    <span class="text-xs text-gray-500">~${Math.ceil(item.distance * 5)} menit</span>
                                </div>
                            </div>

                            <!-- Image -->
                            ${item.image ? `
                                <img src="/image/umkm/${item.image}"
                                     class="w-full h-40 object-cover rounded-lg mb-3"
                                     alt="${item.name}">
                            ` : ''}

                            <!-- Info -->
                            <div class="space-y-2 text-sm text-gray-700">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 mt-0.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>${item.address || '-'}</span>
                                </div>

                                ${item.phone ? `
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                        <span>${item.phone}</span>
                                    </div>
                                ` : ''}

                                ${item.opening_hours ? `
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>${item.opening_hours}</span>
                                    </div>
                                ` : ''}
                            </div>

                            <!-- Facilities -->
                            ${servicesHtml ? `
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <div class="font-semibold text-sm text-gray-700 mb-2">Fasilitas Tersedia:</div>
                                    <div class="grid grid-cols-2 gap-2">
                                        ${servicesHtml}
                                    </div>
                                </div>
                            ` : ''}

                            <!-- Actions -->
                            <div class="mt-4 pt-3 border-t border-gray-200 flex gap-2">
                                <button onclick="focusMarker(${item.id})"
                                        class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm font-medium">
                                    Buka di Google Maps
                                </button>
                                <button onclick="flyToMarker(${item.lat}, ${item.lng})"
                                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition text-sm font-medium">
                                    Lihat di Peta
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            })
            .join("");
    }

    function focusUserLocation() {
        if (!userMarker) return alert("Lokasi belum tersedia");
        map.setView(userMarker.getLatLng(), 18);
        userMarker.openPopup();
    }

    function focusMarker(umkmId) {
        const item = markers.find(m => m.id === umkmId);
        if (!item) return;

        // Buka Google Maps dengan directions
        const userPos = userMarker ? userMarker.getLatLng() : null;
        if (userPos) {
            const url = `https://www.google.com/maps/dir/?api=1&origin=${userPos.lat},${userPos.lng}&destination=${item.lat},${item.lng}`;
            window.open(url, '_blank');
        } else {
            const url = `https://www.google.com/maps/search/?api=1&query=${item.lat},${item.lng}`;
            window.open(url, '_blank');
        }
    }

    function flyToMarker(lat, lng) {
        map.flyTo([lat, lng], 18, {
            duration: 1.5
        });

        // Find and open popup
        const item = markers.find(m => m.lat === lat && m.lng === lng);
        if (item) {
            setTimeout(() => {
                item.marker.openPopup();
            }, 1600);
        }
    }

    // Listen to filter changes
    document.getElementById("filterCategory").addEventListener("change", applyFilters);
    document.getElementById("filterRadius").addEventListener("change", applyFilters);

    // Initial update list when page loads with user location
    setTimeout(() => {
        if (userMarker) {
            updateUmkmList();
        }
    }, 1000);

</script>

@endsection
