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
        'no_telp_pemohon',
        'email_pemohon',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function detailPemohonKuliah()
    {
        return $this->hasOne(DetailPemohonKuliah::class);
    }

    public function detailPemohonSekolah()
    {
        return $this->hasOne(DetailPemohonSekolah::class);
    }
}
