@extends('layouts.app')
@section('title', 'Kegiatan')
@section('content')
    <div class="container mx-auto mt-6">
        <!-- Judul halaman + tombol tambah kegiatan -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Kegiatan</h1>
            <button id="btnAdd" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah
            </button>
        </div>

        <!-- Tabel kegiatan -->
        <div class=" bg-white rounded-lg shadow">
            <div class="p-4">
                <table id="datatable" class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 w-5 text-left">No</th>
                            <th class="px-4 py-2 text-left">Anggota</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Lokasi</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 lg:w-[180px] text-left">Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
    <div id="formModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl mx-4">
            <h2 id="modalTitle" class="text-xl font-bold p-4 border-b"></h2>
            <div id="modalBody"></div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('vendor/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            // inisialisasi select2
            let table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('kegiatan.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'anggota_nama',
                        name: 'anggota_nama'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // buka modal CREATE
            $(document).on('click', '#btnAdd', function() {
                $.get("{{ route('kegiatan.create') }}", function(res) {
                    $('#modalTitle').text('Tambah Kegiatan');
                    $('#modalBody').html(res);
                    $('#formModal').removeClass('hidden');
                });
            });

            // Event handler tombol delete
            $(document).on('click', '.deleteBtn', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/kegiatan/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: response.success,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                $('#datatable').DataTable().ajax
                            .reload(); // reload tabel
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus data.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // buka modal EDIT
            $(document).on('click', '.editBtn', function() {
                let id = $(this).data('id');
                $.get("{{ url('kegiatan') }}/" + id + "/edit", function(res) {
                    $('#modalTitle').text('Edit Kegiatan');
                    $('#modalBody').html(res);
                    $('#formModal').removeClass('hidden');
                });
            });

            // simpan form (dinamis untuk create/edit)
            $(document).on('submit', '#formKegiatan', function(e) {
                e.preventDefault();
                let mode = $(this).data('mode');
                let id = $(this).data('id');
                let url = mode === 'edit' ? "{{ url('kegiatan') }}/" + id :
                    "{{ route('kegiatan.store') }}";

                $.ajax({
                    url: url,
                    method: mode === 'edit' ? 'PUT' : 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(res) {
                        setTimeout(() => {
                            Swal.close();
                            $('#formModal').addClass('hidden');
                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }, 1000);
                    },
                    error: function(xhr) {
                        setTimeout(() => {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan, periksa input!'
                            });
                        }, 1000);
                    }
                });
            });

            // buka modal DETAIL
            $(document).on('click', '.detailBtn', function() {
                let id = $(this).data('id');
                $.get("{{ url('kegiatan') }}/" + id, function(res) {
                    $('#modalTitle').text('Detail Kegiatan');
                    $('#modalBody').html(res);
                    $('#formModal').removeClass('hidden');
                });
            });


            // close modal
            $(document).on('click', '#btnClose', function() {
                $('#formModal').addClass('hidden');
            });
        });
    </script>
@endpush
