@extends('layouts.auth')

@section('content')
    <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
        <h1 class="text-2xl font-bold text-center">Register</h1>

        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" class="border p-2 w-full rounded"
                value="{{ old('name') }}" required>

            <input type="email" name="email" placeholder="Email" class="border p-2 w-full rounded"
                value="{{ old('email') }}" required>

            <input type="password" name="password" placeholder="Password" class="border p-2 w-full rounded" required>

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="border p-2 w-full rounded" required>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
@endsection
