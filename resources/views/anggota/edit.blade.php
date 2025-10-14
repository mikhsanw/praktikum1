@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-4 mt-10 bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Edit Anggota</h1>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}"
                    class="w-full border rounded px-3 py-2">
                @error('nama')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $anggota->nim) }}"
                    class="w-full border rounded px-3 py-2">
                @error('nim')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $anggota->email) }}"
                    class="w-full border rounded px-3 py-2">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Prodi</label>
                <input type="text" name="prodi" value="{{ old('prodi', $anggota->prodi) }}"
                    class="w-full border rounded px-3 py-2">
                @error('prodi')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('anggota.index') }}" class="text-gray-600 hover:underline">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
