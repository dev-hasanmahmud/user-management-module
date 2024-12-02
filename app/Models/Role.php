<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
