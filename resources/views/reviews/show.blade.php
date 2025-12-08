@extends('layouts.app')
@section('title', 'Detail UMKM - ' . $umkm->name)
@section('content')

<div class="container mx-auto p-4 max-w-6xl">
    <!-- Back Button -->
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 mb-4">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - UMKM Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- UMKM Detail Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($umkm->image)
                    <img src="{{ $umkm->image }}"
                         class="w-full h-64 object-cover"
                         alt="{{ $umkm->name }}">
                @endif

                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $umkm->name }}</h1>
                            <div class="flex items-center gap-2 mt-2">
                                @if($umkm->category_icon)
                                    <img src="/image/icons/{{ $umkm->category_icon }}" class="w-6 h-6">
                                @endif
                                <span class="text-gray-600">{{ $umkm->category_name }}</span>
                            </div>
                        </div>

                        <!-- Rating Display -->
                        <div class="text-right">
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600">
                                {{ number_format($avgRating, 1) }} ({{ $totalReviews }} review)
                            </span>
                        </div>
                    </div>

                    <!-- Info Details -->
                    <div class="space-y-3 text-gray-700">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $umkm->address ?? '-' }}</span>
                        </div>

                        @if($umkm->phone)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>{{ $umkm->phone }}</span>
                        </div>
                        @endif

                        @if($umkm->opening_hours)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $umkm->opening_hours }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Services -->
                    @if($umkm->services->count() > 0)
                    <div class="mt-6 pt-6 border-t">
                        <h3 class="font-semibold text-lg mb-3">Fasilitas Tersedia</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($umkm->services as $service)
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $service->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Review & Rating</h2>

                <!-- Review Form -->
                @if(!$userReview)
                <div class="bg-blue-50 p-4 rounded-lg mb-6">
                    <h3 class="font-semibold mb-3">Berikan Review Anda</h3>
                    <form action="{{ route('reviews.store', $umkm->id) }}" method="POST">
                        @csrf

                        <!-- Rating Stars -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">Rating</label>
                            <div class="flex gap-2" id="ratingStars">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        onclick="setRating({{ $i }})"
                                        class="star-btn text-gray-300 hover:text-yellow-400 transition">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="ratingInput" required>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Comment -->
                        <div class="mb-4">
                            <label class="block font-medium mb-2">Komentar (Opsional)</label>
                            <textarea name="comment"
                                      rows="4"
                                      class="w-full border rounded-lg px-3 py-2"
                                      placeholder="Ceritakan pengalaman Anda...">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            Kirim Review
                        </button>
                    </form>
                </div>
                @else
                <!-- User's Existing Review -->
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg mb-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold">Review Anda</h3>
                        <div class="flex gap-2">
                            <button onclick="editReview({{ $userReview->id }}, {{ $userReview->rating }}, '{{ addslashes($userReview->comment) }}')"
                                    class="text-blue-600 hover:text-blue-700 text-sm">
                                Edit
                            </button>
                            <form action="{{ route('reviews.destroy', $userReview->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $userReview->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700">{{ $userReview->comment ?? 'Tidak ada komentar' }}</p>
                    <p class="text-sm text-gray-500 mt-2">{{ $userReview->created_at }}</p>
                </div>
                @endif

                <!-- All Reviews -->
                <div class="space-y-4">
                    <h3 class="font-semibold text-lg">Semua Review ({{ $totalReviews }})</h3>

                    @forelse($reviews as $review)
                    <div class="border-b pb-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold">{{ $review->user_name ?? 'Pengguna' }}</p>
                                <div class="flex gap-1 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $review->created_at }}</span>
                        </div>
                        <p class="text-gray-700">{{ $review->comment ?? 'Tidak ada komentar' }}</p>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-8">Belum ada review</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column - Map -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-4 sticky top-4">
                <h3 class="font-semibold mb-3">Lokasi</h3>
                <div id="map" class="w-full h-64 rounded-lg mb-3"></div>
                <a href="https://www.google.com/maps/search/?api=1&query={{ $umkm->lat }},{{ $umkm->lng }}"
                   target="_blank"
                   class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700">
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold mb-4">Edit Review</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-2">Rating</label>
                <div class="flex gap-2" id="editRatingStars">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button"
                            onclick="setEditRating({{ $i }})"
                            class="edit-star-btn text-gray-300 hover:text-yellow-400 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="editRatingInput" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Komentar</label>
                <textarea name="comment"
                          id="editComment"
                          rows="4"
                          class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
                <button type="button"
                        onclick="closeEditModal()"
                        class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Rating functionality
    function setRating(rating) {
        document.getElementById('ratingInput').value = rating;
        const stars = document.querySelectorAll('#ratingStars .star-btn');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    function setEditRating(rating) {
        document.getElementById('editRatingInput').value = rating;
        const stars = document.querySelectorAll('#editRatingStars .edit-star-btn');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    function editReview(id, rating, comment) {
        document.getElementById('editForm').action = `/reviews/${id}`;
        setEditRating(rating);
        document.getElementById('editComment').value = comment;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Map
    const map = L.map('map').setView([{{ $umkm->lat }}, {{ $umkm->lng }}], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @if($umkm->category_icon)
    const customIcon = L.icon({
        iconUrl: '/image/icons/{{ $umkm->category_icon }}',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
    });
    @else
    const customIcon = L.icon({
        iconUrl: '/image/icons/default.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
    });
    @endif

    L.marker([{{ $umkm->lat }}, {{ $umkm->lng }}], { icon: customIcon })
        .addTo(map)
        .bindPopup('<b>{{ $umkm->name }}</b>')
        .openPopup();
</script>

@endsection
