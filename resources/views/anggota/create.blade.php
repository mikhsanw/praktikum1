@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-4 mt-10 bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Tambah Anggota</h1>

        <form action="{{ route('anggota.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('nama')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('nim')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Prodi</label>
                <input type="text" name="prodi" value="{{ old('prodi') }}"
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                @error('prodi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('anggota.index') }}" class="text-gray-600 hover:underline">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
