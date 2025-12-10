<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $user->update(['name' => $request->name]);

        if ($request->hasFile('profile')) {
            // hapus file lama
            if ($user->file) {
                Storage::delete($user->file->path);
                $user->file->delete();
            }

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->id.'_'.time().'.'.$extension;
            $folder = 'profiles/'.$user->id;
            $path = $file->storeAs($folder, $filename);

            $user->file()->create([
                'alias' => 'foto-profil',
                'filename' => $filename,
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Profile berhasil diperbarui');
    }
}
