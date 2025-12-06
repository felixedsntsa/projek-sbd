@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="flex h-screen">

    {{-- Sidebar --}}
    <div class="w-72 bg-white shadow-xl p-4 overflow-y-auto">

        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">
            Profil
        </a>

        <h2 class="text-xl font-bold mb-4">Daftar UMKM</h2>

        <input
            type="text"
            id="searchInput"
            placeholder="Cari UMKM..."
            class="w-full px-3 py-2 border rounded mb-4"
        >

        <div class="mb-3">
            <label class="block font-semibold mb-1">Filter Kategori</label>
            <select id="filterCategory" class="w-full px-3 py-2 border rounded">
                <option value="">Semua</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <ul id="umkmList" class="mt-3 space-y-3">
            @foreach ($umkm as $item)
                <li class="p-3 border rounded cursor-pointer hover:bg-gray-100"
                    onclick="focusMarker({{ $item->id }})">
                    <strong>{{ $item->name }}</strong><br>
                    <small>{{ $item->address }}</small>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Logout
            </button>
        </form>

    </div>

    {{-- Map --}}
    <div id="map" class="flex-1"></div>

</div>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([-8.164987, 113.713421], 15);

    // Load OSM Tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let markers = [];

    // Data UMKM dari Laravel (sudah termasuk category_icon & category_name)
    const umkmData = @json($umkm);

    // Tampilkan marker
    umkmData.forEach(item => {

        // Ambil icon kategori
        const iconPath = item.category_icon
            ? `/image/icons/${item.category_icon}`
            : `/image/icons/default.png`; // icon default bila kategori kosong

        // Buat custom icon
        const customIcon = L.icon({
            iconUrl: iconPath,
            iconSize: [50, 50],
            iconAnchor: [25, 50],
            popupAnchor: [0, -45]
        });

        let marker = L.marker([item.lat, item.lng], { icon: customIcon }).addTo(map);

        marker.bindPopup(`
            <div class="font-semibold text-lg mb-2">${item.name}</div>
            <img src="/image/umkm/${item.image ?? 'no_image.jpg'}"
                class="w-full h-32 object-cover rounded mb-2">

            <div><strong>Kategori:</strong> ${item.category_name ?? '-'}</div>
            <div><strong>Alamat:</strong> ${item.address ?? '-'}</div>
            <div><strong>Telepon:</strong> ${item.phone ?? '-'}</div>
            <div><strong>Jam Operasional:</strong> ${item.opening_hours ?? '-'}</div>
        `);

        markers[item.id] = marker;
    });

    // Fokus ke marker dari sidebar
    function focusMarker(id) {
        map.setView(markers[id].getLatLng(), 18);
        markers[id].openPopup();
    }
</script>


@endsection
