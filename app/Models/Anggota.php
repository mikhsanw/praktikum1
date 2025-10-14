<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Anggota extends Model
{
    use SoftDeletes, HasUuids;
    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $fillable = ['nama', 'nim', 'email', 'prodi'];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

}
