@extends('layouts.app')
@section('title', 'Anggota')
@section('content')

    <div class="max-w-4xl mx-auto mt-10">
        <!-- Judul halaman + tombol tambah anggota -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Anggota</h1>
            <a href="{{ route('anggota.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah Anggota
            </a>
        </div>

        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel anggota -->
        <div class=" bg-white rounded-lg shadow">
            <div class="p-4">
                <table id="usersTable" class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">NIM</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Prodi</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas as $anggota)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $anggota->nama }}</td>
                                <td class="px-4 py-2">{{ $anggota->nim }}</td>
                                <td class="px-4 py-2">{{ $anggota->email }}</td>
                                <td class="px-4 py-2">{{ $anggota->prodi }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <!-- Link detail / edit / hapus -->
                                    <a href="{{ route('anggota.show', $anggota->id) }}"
                                        class="text-blue-600 hover:underline">Detail</a>
                                    <a href="{{ route('anggota.edit', $anggota->id) }}"
                                        class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="dt-empty">
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada anggota</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    @endsection
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.tailwindcss.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.4/js/dataTables.tailwindcss.min.js"></script>
        <script>
            $.fn.dataTable.ext.errMode = 'none';
            $(function() {
                $('#usersTable').DataTable({
                    initComplete: function() {
                        // Hapus class dark dari elemen-elemen input/dropdown
                        $('select, input[type="search"], .pagination a').each(function() {
                            this.className = this.className
                                .split(' ')
                                .filter(cls => !cls.startsWith('dark:'))
                                .join(' ');
                        });
                    }
                });
            });
        </script>
    @endpush
