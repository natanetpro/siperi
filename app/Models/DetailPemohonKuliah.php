<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemohonKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemohon_id',
        'nim',
        'universitas',
        'fakultas',
        'prodi',
        'semester',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }
}
