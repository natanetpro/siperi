<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Kegiatan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'pemohon_id',
        'jenis_kegiatan',
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'approval_admin',
        'catatan_admin',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class, 'pemohon_id');
    }

    public function userKegiatans()
    {
        return $this->hasMany(UserKegiatan::class, 'kegiatan_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('riset')->singleFile();
        $this->addMediaCollection('kkp')->singleFile();
        $this->addMediaCollection('prakerin')->singleFile();
    }
}
