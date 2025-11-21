<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_nombre',
        'cliente_email',
        'cliente_telefono',
        'total',
        'estado',
    ];

    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
