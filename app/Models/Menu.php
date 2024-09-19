<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'key',
        'panel_id',
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

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent', 'key');
    }

    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }
}
