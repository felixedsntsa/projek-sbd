@extends('layouts.app')
@section('title', 'Profil Saya')
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
        </div>
    </div>
</div>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 p-4">
    <div class="max-w-2xl w-full">
        <!-- Main Profile Card -->
        <div class="backdrop-blur-xl bg-white/90 border border-white/20 rounded-3xl shadow-2xl overflow-hidden">

            <!-- Header with Gradient Background -->
            <div class="h-32 bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-600 relative">
                <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center text-white text-5xl font-bold shadow-2xl border-8 border-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 rounded-full border-4 border-white flex items-center justify-center animate-pulse">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="pt-20 pb-8 px-8">
                <!-- Name & Email -->
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $user->name }}</h1>
                    <p class="text-gray-600 text-lg">{{ $user->email }}</p>
                    <div class="inline-flex items-center mt-3 px-4 py-1.5 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full text-blue-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Anggota sejak {{ $user->created_at ? $user->created_at->format('M Y') : '-' }}
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <!-- Name Card -->
                    <div class="p-5 bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-100 hover:border-blue-300 transition-all hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="p-5 bg-gradient-to-br from-green-50 to-white rounded-2xl border border-green-100 hover:border-green-300 transition-all hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Alamat Email</p>
                                <p class="text-lg font-semibold text-gray-800 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Join Date Card -->
                    <div class="p-5 bg-gradient-to-br from-purple-50 to-white rounded-2xl border border-purple-100 hover:border-purple-300 transition-all hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Bergabung Sejak</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Last Update Card -->
                    <div class="p-5 bg-gradient-to-br from-amber-50 to-white rounded-2xl border border-amber-100 hover:border-amber-300 transition-all hover:shadow-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Terakhir Diperbarui</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $user->updated_at ? $user->updated_at->format('d/m/Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}"
                       class="px-8 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                                class="w-full px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-blue-500/25 transform hover:scale-105 transition-all flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="text-center p-4 bg-white/80 backdrop-blur-sm rounded-2xl border border-white/20 shadow">
                <div class="text-2xl font-bold text-blue-600">0</div>
                <div class="text-sm text-gray-600">UMKM</div>
            </div>
            <div class="text-center p-4 bg-white/80 backdrop-blur-sm rounded-2xl border border-white/20 shadow">
                <div class="text-2xl font-bold text-green-600">0</div>
                <div class="text-sm text-gray-600">Kunjungan</div>
            </div>
            <div class="text-center p-4 bg-white/80 backdrop-blur-sm rounded-2xl border border-white/20 shadow">
                <div class="text-2xl font-bold text-purple-600">0</div>
                <div class="text-sm text-gray-600">Favorit</div>
            </div>
        </div>
    </div>
</div>

<style>
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hover effects */
    .hover\:shadow-lg:hover {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Gradient animation */
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }

    /* Responsive adjustments */
    @media (max-height: 800px) {
        .min-h-screen {
            min-height: 800px;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
    }
</style>

@endsection
