<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemohonSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemohon_id',
        'nis',
        'jurusan',
        'sekolah',
        'kelas',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }
}
