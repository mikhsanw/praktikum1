<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanApiController extends Controller
{
    public function index()
    {
        return response()->json(Kegiatan::with('anggota')->get());
    }

    public function show($id)
    {
        $e = Kegiatan::with('anggota')->find($id);
        if (! $e) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        return response()->json($e);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'nama_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal' => 'required|date',
        ]);
        $k = Kegiatan::create($data);

        return response()->json(['message' => 'Kegiatan dibuat', 'data' => $k], 201);
    }

    public function update(Request $req, $id)
    {
        $k = Kegiatan::findOrFail($id);
        $k->update($req->only(['anggota_id', 'nama_kegiatan', 'lokasi', 'tanggal']));

        return response()->json(['message' => 'Kegiatan diperbarui', 'data' => $k]);
    }

    public function destroy($id)
    {
        $k = Kegiatan::findOrFail($id);
        $k->delete();

        return response()->json(['message' => 'Kegiatan dihapus']);
    }
}
