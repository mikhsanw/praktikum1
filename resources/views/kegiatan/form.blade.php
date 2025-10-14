<div class="p-4">
    <form id="formKegiatan" data-mode="{{ $mode }}" data-id="{{ $kegiatan->id }}">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="block text-sm">Nama Anggota</label>
            <select name="anggota_id" class="w-full border rounded select2">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($anggotas as $a)
                    <option value="{{ $a->id }}"
                        {{ $a->id == old('anggota_id', $kegiatan->anggota_id) ? 'selected' : '' }}>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="w-full border rounded p-2"
                value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}">
        </div>

        <div class="mb-3">
            <label class="block text-sm">Lokasi</label>
            <input type="text" name="lokasi" class="w-full border rounded p-2"
                value="{{ old('lokasi', $kegiatan->lokasi) }}">
        </div>

        <div class="mb-3">
            <label class="block text-sm">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border rounded p-2"
                value="{{ old('tanggal', $kegiatan->tanggal) }}">
        </div>

        <div class="flex justify-end gap-2">
            <button type="button" id="btnClose" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

{{-- Custom styles dan script untuk select2 --}}
<style>
    /* Select2 full width */
    .select2-container {
        width: 100% !important;
    }

    /* Biar mirip dengan input Tailwind */
    .select2-container .select2-selection--single {
        height: 40px;
        /* sama dengan h-10 */
        padding: 6px 12px;
        /* padding input */
        border: 1px solid #d1d5db;
        /* border-gray-300 */
        border-radius: 0.375rem;
        /* rounded-md */
        display: flex;
        align-items: center;
    }

    /* Placeholder biar rata */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px;
        /* teks di tengah */
        color: #374151;
        /* text-gray-700 */
    }

    /* Panah dropdown */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
        right: 8px;
    }
</style>
<script>
    // Inisialisasi select2
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#formModal')
        });
    });
</script>
