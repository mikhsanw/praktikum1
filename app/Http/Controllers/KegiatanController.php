<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kegiatans = Kegiatan::with('anggota');

            return datatables()->of($kegiatans)
                ->addIndexColumn()
                ->addColumn('anggota_nama', function ($row) {
                    return $row->anggota ? $row->anggota->nama : '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '
                        <div>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded-sm detailBtn" data-id="'.$row->id.'">Detail</button>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-sm editBtn" data-id="'.$row->id.'">Edit</button>
                            <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-sm deleteBtn" data-id="'.$row->id.'">Hapus</button>
                        </div>
                    ';
                })
                ->rawColumns(['aksi']) // biar button tidak di-escape
                ->make(true);
        }

        return view('kegiatan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required|date',
        ]);

        Kegiatan::create($request->all());

        return response()->json(['message' => 'Kegiatan berhasil ditambahkan']);
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('anggota')->findOrFail($id);

        return view('kegiatan.show', compact('kegiatan'));
    }

    public function create()
    {
        $anggotas = \App\Models\Anggota::all();

        return view('kegiatan.form', [
            'kegiatan' => new Kegiatan,
            'anggotas' => $anggotas,
            'mode' => 'create',
        ]);
    }

    public function edit($id)
    {
        $kegiatan = \App\Models\Kegiatan::findOrFail($id);
        $anggotas = \App\Models\Anggota::all();

        return view('kegiatan.form', [
            'kegiatan' => $kegiatan,
            'anggotas' => $anggotas,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required|date',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return response()->json(['message' => 'Kegiatan berhasil diperbarui']);
    }

    public function destroy($id)
    {
        Kegiatan::findOrFail($id)->delete();

        return response()->json(['message' => 'Kegiatan berhasil dihapus']);
    }
}
