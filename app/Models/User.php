<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'no_telp',
        'password',
        'pemohon_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }

    public function userPemohon()
    {
        return $this->hasMany(UserPembimbing::class, 'pemohon_id');
    }

    public function userPembimbing()
    {
        return $this->hasMany(UserPembimbing::class, 'pembimbing_id');
    }

    public function userKegiatans()
    {
        return $this->hasMany(UserKegiatan::class, 'user_id');
    }
}
