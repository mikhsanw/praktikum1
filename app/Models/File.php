<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasUuids;

    protected $fillable = ['alias', 'filename', 'path', 'mime_type', 'size'];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getFileStreamAttribute()
    {
        return route('files.action', ['id' => $this->id, 'action' => 'stream']);
    }

    public function getFileDownloadAttribute()
    {
        return route('files.action', ['id' => $this->id, 'action' => 'download']);
    }

    public function handleAction($action)
    {
        if (! Storage::disk('public')->exists($this->path)) {
            abort(404, 'File tidak ditemukan');
        }

        if ($action === 'stream') {
            return response()->file(Storage::disk('public')->path($this->path), [
                'Content-Type' => $this->mime_type,
            ]);
        }

        if ($action === 'download') {
            return Storage::disk('public')->download($this->path, $this->filename);
        }

        abort(400, 'Aksi tidak valid');
    }
}
