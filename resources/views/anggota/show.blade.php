@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $anggota->nama }}</h1>

    <p><strong>NIM:</strong> {{ $anggota->nim }}</p>
    <p><strong>Email:</strong> {{ $anggota->email }}</p>
    <p><strong>Prodi:</strong> {{ $anggota->prodi }}</p>

    <h2 class="text-lg font-semibold mt-6 mb-2">Kegiatan Diikuti</h2>
    @if($anggota->kegiatans->count())
        <ul class="list-disc ml-5">
            @foreach ($anggota->kegiatans as $kegiatan)
                <li>{{ $kegiatan->nama_kegiatan }} ({{ $kegiatan->tanggal }})</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Belum ada kegiatan</p>
    @endif

    <div class="mt-6 flex justify-between">
        <a href="{{ route('anggota.index') }}"
           class="text-gray-600 hover:underline">Kembali</a>
        <a href="{{ route('anggota.edit', $anggota->id) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
           Edit
        </a>
    </div>
</div>
@endsection

