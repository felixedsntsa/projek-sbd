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
<div class="container mx-auto px-4 py-6 max-w-7xl">

    <!-- Filter & Location Card -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 mb-6 border border-gray-200/50">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Filter & Lokasi</h2>
                <p class="text-gray-500 mt-1">Sesuaikan pencarian UMKM berdasarkan preferensi Anda</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column - Filters -->
            <div class="space-y-6">
                <!-- Category Filter -->
                <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-blue-300 transition-colors">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                        </svg>
                        Kategori UMKM
                    </label>
                    <div class="relative">
                        <select id="filterCategory"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all appearance-none">
                            <option value="all" class="py-2">Semua Kategori</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->name }}" class="py-2">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Radius Filter -->
                <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-blue-300 transition-colors">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                        </svg>
                        Radius Pencarian
                    </label>
                    <div class="relative">
                        <select id="filterRadius"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all appearance-none">
                            <option value="0" class="py-2">Tampilkan Semua</option>
                            <option value="1" class="py-2">Dalam 1 km</option>
                            <option value="2" class="py-2">Dalam 2 km</option>
                            <option value="3" class="py-2">Dalam 3 km</option>
                            <option value="4" class="py-2">Dalam 4 km</option>
                            <option value="5" class="py-2">Dalam 5 km</option>
                        </select>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Location Inputs -->
            <div class="space-y-6">
                <!-- Coordinates Input -->
                <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-emerald-300 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            Koordinat Lokasi
                        </label>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">GPS</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-2">Latitude</label>
                            <div class="relative">
                                <input type="text" id="latInput"
                                       value="{{ session('user_lat') ?? '' }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                       placeholder="Contoh: -6.200000">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <span class="text-xs text-gray-400">°</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-2">Longitude</label>
                            <div class="relative">
                                <input type="text" id="lngInput"
                                       value="{{ session('user_lng') ?? '' }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                       placeholder="Contoh: 106.816666">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <span class="text-xs text-gray-400">°</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <button onclick="focusUserLocation()"
                        class="group flex items-center justify-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Lokasi Saya</span>
                    </button>

                    <button onclick="setLocationFromInput()"
                        class="group flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-11 11a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L5 15.586 15.293 5.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Set Manual</span>
                    </button>

                    <a href="{{ route('profile') }}"
                        class="group flex items-center justify-center gap-3 bg-gradient-to-r from-gray-700 to-gray-800 text-white px-4 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <span>Profile</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total UMKM</p>
                            <p class="text-xl font-bold text-gray-900" id="umkmCount">{{ $umkm->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-emerald-50 to-green-50 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dalam Radius</p>
                            <p class="text-xl font-bold text-gray-900" id="inRadiusCount">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="text-xl font-bold text-gray-900">{{ $categories->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 border border-gray-200/50">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Peta Lokasi UMKM</h2>
                    <p class="text-gray-500 mt-1">Visualisasi UMKM dalam area yang Anda pilih</p>
                </div>
                <button onclick="resetMapView()"
                    class="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    Reset View
                </button>
            </div>
        </div>
        <div id="map" class="w-full h-[500px]"></div>
    </div>

    <!-- UMKM List Section -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200/50">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Daftar UMKM</h2>
                    <p class="text-gray-500 mt-1">Temukan UMKM terdekat berdasarkan lokasi Anda</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text"
                               id="searchUMKM"
                               placeholder="Cari UMKM..."
                               class="px-4 py-2 pl-10 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button onclick="sortByDistance()"
                        class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                        </svg>
                        Sortir Jarak
                    </button>
                </div>
            </div>
        </div>
        <div id="umkmList" class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto">
            <!-- Loading placeholder -->
            <div class="p-8 text-center text-gray-400">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-gray-600">Memuat data UMKM...</p>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-8.164987, 113.713421], 15);

    // Use a nicer tile layer
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '© OpenStreetMap, © CartoDB',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);

    let userMarker = null;
    let radiusCircle = null;
    let markers = [];
    const umkmData = @json($umkm);

    // Initialize the map with UMKM data
    umkmData.forEach(item => {
        const iconPath = item.category_icon
            ? `/image/icons/${item.category_icon}`
            : `/image/icons/default.png`;

        const customIcon = L.icon({
            iconUrl: iconPath,
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        let marker = L.marker([item.lat, item.lng], {
            icon: customIcon,
            riseOnHover: true
        });

        // Build services list HTML for popup
        let servicesHtml = '';
        if (item.services && item.services.length > 0) {
            servicesHtml = '<div class="mt-2"><strong class="text-sm">Fasilitas:</strong><ul class="list-disc ml-4 mt-1">';
            item.services.forEach(service => {
                servicesHtml += `<li class="text-sm">${service.name}</li>`;
            });
            servicesHtml += '</ul></div>';
        }

        marker.bindPopup(`
            <div class="p-3 min-w-[250px]">
                <div class="font-bold text-lg text-gray-900 mb-2">${item.name}</div>
                <img src="${item.image ?? 'no_image.jpg'}"
                    class="w-full h-36 object-cover rounded-lg mb-3">
                <div class="space-y-2 text-sm text-gray-700">
                    <div><strong>Kategori:</strong> ${item.category_name ?? '-'}</div>
                    <div><strong>Alamat:</strong> ${item.address ?? '-'}</div>
                    <div><strong>Telepon:</strong> ${item.phone ?? '-'}</div>
                    <div><strong>Jam:</strong> ${item.opening_hours ?? '-'}</div>
                </div>
                ${servicesHtml}
                <div class="mt-3 pt-3 border-t">
                    <a href="/umkm/${item.id}"
                        class="block w-full bg-blue-600 text-center text-white px-3 py-2 rounded-lg hover:bg-blue-700 text-white text-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
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

    // Update input fields
    function updateInputs(lat, lng) {
        document.getElementById("latInput").value = lat;
        document.getElementById("lngInput").value = lng;
    }

    // Draw radius circle
    function drawRadius(lat, lng, km) {
        if (radiusCircle) map.removeLayer(radiusCircle);

        if (km > 0) {
            radiusCircle = L.circle([lat, lng], {
                radius: km * 1000,
                color: "#10B981",
                fillColor: "#34D399",
                fillOpacity: 0.15,
                weight: 2,
                dashArray: "10, 10",
                opacity: 0.8
            }).addTo(map);
        }
    }

    // Set user marker
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

    map.on("locationfound", e => {
        setUserMarker(e.latitude, e.longitude);
        showNotification('success', 'Lokasi berhasil dideteksi!');
    });

    map.on("locationerror", () => {
        showNotification('warning', 'Gagal mendeteksi lokasi. Silakan input manual.');
    });

    // Set location from input
    function setLocationFromInput() {
        let lat = parseFloat(document.getElementById("latInput").value);
        let lng = parseFloat(document.getElementById("lngInput").value);

        if (isNaN(lat) || isNaN(lng)) {
            showNotification('error', 'Latitude/Longitude tidak valid');
            return;
        }

        setUserMarker(lat, lng);
        map.flyTo([lat, lng], 17, {
            duration: 1
        });
        showNotification('success', 'Lokasi berhasil diupdate!');
    }

    // Calculate distance
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

    // Apply filters
    function applyFilters() {
        let selectedCategory = document.getElementById("filterCategory").value;
        let selectedRadius = parseFloat(document.getElementById("filterRadius").value);

        // Remove all markers first
        markers.forEach(item => map.removeLayer(item.marker));

        let lat = parseFloat(document.getElementById("latInput").value);
        let lng = parseFloat(document.getElementById("lngInput").value);

        // Draw radius
        drawRadius(lat, lng, selectedRadius);

        // Filter markers
        let inRadiusCount = 0;
        markers.forEach(item => {
            let show = true;

            if (selectedCategory !== "all" && item.category !== selectedCategory) {
                show = false;
            }

            if (selectedRadius > 0 && userMarker) {
                let userPos = userMarker.getLatLng();
                let distance = getDistance(userPos.lat, userPos.lng, item.lat, item.lng);

                if (distance > selectedRadius) {
                    show = false;
                } else {
                    inRadiusCount++;
                }
            }

            if (show) item.marker.addTo(map);
        });

        // Update stats
        document.getElementById('inRadiusCount').textContent = inRadiusCount;

        // Update list
        updateUmkmList();
    }

    // Update UMKM list
    function updateUmkmList() {
        const umkmListContainer = document.getElementById("umkmList");

        if (!userMarker) {
            umkmListContainer.innerHTML = `
                <div class="p-8 text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-lg font-medium text-gray-500">Lokasi belum ditemukan</p>
                    <p class="text-sm mt-1">Gunakan tombol "Lokasi Saya" atau input koordinat manual</p>
                </div>
            `;
            return;
        }

        let selectedCategory = document.getElementById("filterCategory").value;
        let selectedRadius = parseFloat(document.getElementById("filterRadius").value);
        let userPos = userMarker.getLatLng();

        // Calculate distances and filter
        let nearby = markers
            .map(item => {
                let distance = getDistance(userPos.lat, userPos.lng, item.lat, item.lng);
                return {
                    ...item,
                    distance: distance
                };
            })
            .filter(item => {
                if (selectedCategory !== "all" && item.category !== selectedCategory) {
                    return false;
                }
                if (selectedRadius > 0 && item.distance > selectedRadius) {
                    return false;
                }
                return true;
            })
            .sort((a, b) => a.distance - b.distance);

        // Render list
        if (nearby.length === 0) {
            umkmListContainer.innerHTML = `
                <div class="p-8 text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-lg font-medium text-gray-500">Tidak ada UMKM ditemukan</p>
                    <p class="text-sm mt-1">Coba ubah radius atau kategori pencarian</p>
                </div>
            `;
            return;
        }

        umkmListContainer.innerHTML = nearby
            .map((item, index) => {
                // Build services
                let servicesHtml = '';
                if (item.services && item.services.length > 0) {
                    servicesHtml = item.services.slice(0, 4).map(service => `
                        <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full text-xs">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            ${service.name}
                        </span>
                    `).join('');

                    if (item.services.length > 4) {
                        servicesHtml += `<span class="text-xs text-gray-500">+${item.services.length - 4} lainnya</span>`;
                    }
                }

                // Estimate travel time (assuming 30km/h average speed)
                const travelTime = Math.ceil(item.distance * 2);

                return `
                    <div class="p-6 hover:bg-gray-50/50 transition-colors group">
                        <div class="flex flex-col lg:flex-row lg:items-start gap-4">
                            <!-- Rank Badge -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                    ${index + 1}
                                </div>
                            </div>

                            <!-- Main Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-3 mb-3">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">${item.name}</h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            ${item.category_icon ?
                                                `<img src="/image/icons/${item.category_icon}" class="w-5 h-5">` :
                                                ''}
                                            <span class="text-sm text-gray-600">${item.category}</span>
                                            <span class="text-xs text-gray-400">•</span>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">${item.distance.toFixed(1)} km</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-blue-600">${item.distance.toFixed(1)} km</div>
                                            <div class="text-sm text-gray-500">~${travelTime} menit</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="space-y-2">
                                        <div class="flex items-start gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Alamat</p>
                                                <p class="text-sm font-medium text-gray-900">${item.address || '-'}</p>
                                            </div>
                                        </div>

                                        ${item.phone ? `
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Telepon</p>
                                                <p class="text-sm font-medium text-gray-900">${item.phone}</p>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>

                                    <div class="space-y-2">
                                        ${item.opening_hours ? `
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Jam Operasional</p>
                                                <p class="text-sm font-medium text-gray-900">${item.opening_hours}</p>
                                            </div>
                                        </div>
                                        ` : ''}

                                        <!-- Services Preview -->
                                        ${servicesHtml ? `
                                        <div class="flex items-start gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 mb-2">Fasilitas</p>
                                                <div class="flex flex-wrap gap-2">
                                                    ${servicesHtml}
                                                </div>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                                    <a href="/umkm/${item.id}"
                                        class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        Lihat Detail & Review
                                    </a>

                                    <button onclick="focusMarker(${item.id})"
                                        class="inline-flex items-center gap-2 bg-white border border-blue-200 text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                                        </svg>
                                        Buka di Google Maps
                                    </button>

                                    <button onclick="flyToMarker(${item.lat}, ${item.lng})"
                                        class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        Lihat di Peta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            })
            .join("");
    }

    // Focus on user location
    function focusUserLocation() {
        if (!userMarker) {
            showNotification('warning', 'Lokasi belum tersedia. Menggunakan lokasi default.');
            map.setView([-8.164987, 113.713421], 15);
            return;
        }
        map.flyTo(userMarker.getLatLng(), 18, {
            duration: 1
        });
        userMarker.openPopup();
    }

    // Focus on marker and open Google Maps
    function focusMarker(umkmId) {
        const item = markers.find(m => m.id === umkmId);
        if (!item) return;

        const userPos = userMarker ? userMarker.getLatLng() : null;
        if (userPos) {
            const url = `https://www.google.com/maps/dir/?api=1&origin=${userPos.lat},${userPos.lng}&destination=${item.lat},${item.lng}&travelmode=driving`;
            window.open(url, '_blank');
        } else {
            const url = `https://www.google.com/maps/search/?api=1&query=${item.lat},${item.lng}`;
            window.open(url, '_blank');
        }
    }

    // Fly to marker on map
    function flyToMarker(lat, lng) {
        map.flyTo([lat, lng], 18, {
            duration: 1.5
        });

        const item = markers.find(m => m.lat === lat && m.lng === lng);
        if (item) {
            setTimeout(() => {
                item.marker.openPopup();
            }, 1600);
        }
    }

    // Reset map view
    function resetMapView() {
        if (userMarker) {
            map.flyTo(userMarker.getLatLng(), 15, {
                duration: 1
            });
        } else {
            map.setView([-8.164987, 113.713421], 15);
        }
    }

    // Sort by distance
    function sortByDistance() {
        updateUmkmList(); // Already sorted by distance
        showNotification('info', 'UMKM diurutkan berdasarkan jarak terdekat');
    }

    // Search functionality
    document.getElementById("searchUMKM").addEventListener("input", function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('#umkmList > div');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Notification function
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-xl shadow-lg text-white font-medium transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-gradient-to-r from-emerald-500 to-green-500' :
            type === 'error' ? 'bg-gradient-to-r from-rose-500 to-red-500' :
            type === 'warning' ? 'bg-gradient-to-r from-amber-500 to-yellow-500' :
            'bg-gradient-to-r from-blue-500 to-cyan-500'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);

        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Event listeners for filters
    document.getElementById("filterCategory").addEventListener("change", applyFilters);
    document.getElementById("filterRadius").addEventListener("change", applyFilters);

    // Initial update
    setTimeout(() => {
        if (userMarker) {
            updateUmkmList();
        } else {
            // Show initial data
            updateUmkmList();
        }
    }, 1500);

</script>

<style>
    /* Custom scrollbar */
    #umkmList::-webkit-scrollbar {
        width: 6px;
    }

    #umkmList::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #umkmList::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    #umkmList::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }

    /* Map custom styles */
    .leaflet-popup-content {
        font-family: 'Inter', system-ui, sans-serif;
    }

    .leaflet-marker-icon {
        transition: transform 0.3s ease;
    }

    .leaflet-marker-icon:hover {
        transform: scale(1.1);
    }
</style>

@endsection
