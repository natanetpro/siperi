<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_kegiatan_id',
        'tanggal',
        'aktivitas',
        'dokumentasi',
        'approval_pembimbing',
        'catatan_pembimbing',
    ];

    public function userKegiatan()
    {
        return $this->belongsTo(UserKegiatan::class, 'user_kegiatan_id');
    }
}
