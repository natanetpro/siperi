<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Panel extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = ['nama'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
