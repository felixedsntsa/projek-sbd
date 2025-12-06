@extends('layouts.app')
@section('title', 'Profile')
@section('content')

<div class="max-w-lg mx-auto bg-white shadow p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Profil Saya</h2>

        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
</div>

@endsection
