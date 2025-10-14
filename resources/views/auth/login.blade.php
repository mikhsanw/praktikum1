@extends('layouts.auth')

@section('content')
    <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
        <h1 class="text-2xl font-bold text-center">Login</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Email"
                    class="border p-2 w-full rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password" placeholder="Password"
                    class="border p-2 w-full rounded @error('password') border-red-500 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                Login
            </button>
        </form>

        <p class="text-center text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
        </p>
    </div>
@endsection
