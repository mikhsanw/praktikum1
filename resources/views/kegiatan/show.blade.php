<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">{{ $kegiatan->nama_kegiatan }}</h1>

    <p><strong>Nama Anggota:</strong> {{ $kegiatan->anggota->nama ?? '-' }}</p>
    <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</p>


    <div class="flex justify-end mt-6">
        <button type="button" id="btnClose" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow">
            Tutup
        </button>
    </div>
</div>
