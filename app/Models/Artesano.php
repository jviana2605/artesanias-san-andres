<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 👈 IMPORTANTE
use Illuminate\Notifications\Notifiable;

class Artesano extends Authenticatable  // 👈 AHORA EXTIENDE Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'artesanos';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'artesano_id');
    }
}
