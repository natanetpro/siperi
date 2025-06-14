<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemimpin',
        'ttd_pemimpin',
        'nip_pemimpin',
        'jabatan_pemimpin',
    ];

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('ttd_pemimpin')
    //         ->singleFile();
    // }
}
