<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasukanSaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_kegiatan_id',
        'masukan_saran',
    ];

    public function userKegiatan()
    {
        return $this->belongsTo(UserKegiatan::class);
    }
}
