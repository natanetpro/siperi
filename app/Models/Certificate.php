<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Certificate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'nama_pemimpin',
        'nip_pemimpin',
        // 'ttd_pemimpin',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('template')
            ->singleFile();
        $this->addMediaCollection('ttd_pemimpin')
            ->singleFile();
    }
}
