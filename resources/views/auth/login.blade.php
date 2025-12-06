@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="min-h-screen relative flex items-center justify-center px-4">
    <!-- Background with gradient overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('/asset/bgprinter.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>
    </div>

    <!-- Decorative elements -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>

    <!-- Main content -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Glass effect card with animation -->
        <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-2xl shadow-2xl p-8 animate-fadeIn">
            <!-- Logo -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold tracking-tight">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Print</span>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-purple-300">Spot</span>
                </h1>
                <p class="text-gray-300 mt-2">Masuk ke akun Anda</p>
            </div>

            <!-- Error messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 backdrop-blur-sm bg-red-500/20 border border-red-400/30 rounded-xl animate-shake">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-red-100">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <!-- Login form -->
            <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 rounded-lg blur opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                        <input type="email"
                               name="email"
                               required
                               placeholder="nama@email.com"
                               value="{{ old('email') }}"
                               class="relative w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg focus:outline-none focus:border-cyan-400/50 text-white placeholder-gray-400 transition-all duration-300">
                        <div class="absolute right-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password field -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-medium text-gray-300">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 rounded-lg blur opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                        <input type="password"
                               name="password"
                               required
                               placeholder="••••••••"
                               class="relative w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg focus:outline-none focus:border-cyan-400/50 text-white placeholder-gray-400 transition-all duration-300">
                        <div class="absolute right-3 top-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit"
                        class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-blue-500/25 transform hover:scale-[1.02] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <span class="flex items-center justify-center">
                        Masuk
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </span>
                </button>
            </form>
        </div>

        <!-- Back to home link -->
        <div class="text-center mt-6">
            <a href="{{ route('landing') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke beranda
            </a>
        </div>
    </div>
</div>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.8s ease-out;
    }

    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    /* Custom placeholder color */
    input::placeholder {
        color: rgba(209, 213, 219, 0.6);
    }

    /* Better focus styles */
    input:focus {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

@endsection
