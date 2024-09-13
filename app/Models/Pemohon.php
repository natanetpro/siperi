<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telp',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
