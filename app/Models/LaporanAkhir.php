<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LaporanAkhir extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_kegiatan_id',
        'approval_pembimbing',
        'catatan_pembimbing',
    ];

    public function userKegiatan()
    {
        return $this->belongsTo(UserKegiatan::class, 'user_kegiatan_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('laporan_akhir')
            ->singleFile();
    }
}
