<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Kegiatan extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = ['anggota_id', 'nama_kegiatan', 'tanggal', 'lokasi'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

}
