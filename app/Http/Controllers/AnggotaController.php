<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::with('kegiatans')->latest()->get();

        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:anggotas,nim',
            'email' => 'required|email|unique:anggotas,email',
            'prodi' => 'required|string|max:50',
        ]);
        $anggota = Anggota::create($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.show', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:anggotas,nim,'.$anggota->id,
            'email' => 'required|email|unique:anggotas,email,'.$anggota->id,
            'prodi' => 'required|string|max:50',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        if (! $anggota) {
            return redirect()->route('anggota.index')
                ->with('error', 'Anggota tidak ditemukan');
        }

        $anggota->kegiatans()->delete();

        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}
