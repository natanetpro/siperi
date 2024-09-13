<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'nama_menu',
        'parent',
        'roles',
        'url',
    ];

    protected $casts = [
        'roles' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent', 'key');
    }
}
