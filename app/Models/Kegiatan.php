<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemoohon_id',
        'jenis_kegiatan',
        'nama_kegiatan',
        'surat_permohonan',
        'tanggal_mulai',
        'tanggal_selesai',
        'approval_admin',
        'catatan_admin',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemoohon_id');
    }

    public function userKegiatans()
    {
        return $this->hasMany(UserKegiatan::class, 'kegiatan_id');
    }
}
