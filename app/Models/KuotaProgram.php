<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuotaProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kegiatan',
        'kuota'
    ];
}
