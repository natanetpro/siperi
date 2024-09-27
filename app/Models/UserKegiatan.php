<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'pembimbing_id',
        'active',
        'hasil'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'user_kegiatan_id');
    }

    public function laporan_akhir()
    {
        return $this->hasOne(LaporanAkhir::class, 'user_kegiatan_id');
    }

    public function masukan()
    {
        return $this->hasMany(MasukanSaran::class, 'user_kegiatan_id');
    }
}
