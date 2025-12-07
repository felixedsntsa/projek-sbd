@extends('layouts.app')
@section('title', 'Landing Page')
@section('content')

<div class="relative min-h-screen bg-cover bg-center" style="background-image: url('/asset/bgprinter.jpg');">
    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>

    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen text-white text-center px-4">
        <!-- Glass blur container -->
        <div class="backdrop-blur-xl bg-white/10 mt-8 mb-8 p-8 md:p-12 rounded-2xl border border-white/20 shadow-2xl max-w-4xl animate-fadeIn">

            <!-- Animated heading -->
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fadeInDown">
                Solusi Pencetakan
                <span class="block mt-2 pb-4 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
                    Digital Terdepan
                </span>
            </h1>

            <!-- Logo/Title -->
            <div class="my-8 animate-fadeIn">
                <h2 class="text-5xl md:text-7xl font-extrabold tracking-tighter">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-400">Print</span>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Spot</span>
                </h2>
                <div class="w-32 h-2 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Brief tagline -->
            <p class="text-xl md:text-2xl font-medium mb-10 max-w-3xl leading-relaxed animate-fadeInUp">
                Temukan berbagai UMKM fotocopy dan printing terdekat dengan solusi cepat, mudah,
                dan profesional dalam genggaman Anda.
            </p>

            <!-- Primary CTA -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl font-semibold text-lg shadow-2xl hover:shadow-blue-500/25 transform hover:scale-105 transition-all duration-300 group">
                    <span>Mulai Sekarang</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>

            <!-- Features grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 pt-8 border-t border-white/20 animate-fadeIn">
                <div class="p-4 backdrop-blur-sm bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Lokasi Terdekat</h3>
                    <p class="text-sm text-gray-300">Temukan tempat print terdekat dari lokasi Anda</p>
                </div>

                <div class="p-4 backdrop-blur-sm bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Proses Cepat</h3>
                    <p class="text-sm text-gray-300">Pencetakan selesai dalam hitungan menit</p>
                </div>

                <div class="p-4 backdrop-blur-sm bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Hasil Profesional</h3>
                    <p class="text-sm text-gray-300">Kualitas cetak tinggi dan terjamin</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out;
    }
    .animate-fadeInDown {
        animation: fadeInDown 0.8s ease-out 0.2s both;
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection
