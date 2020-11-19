<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'cliente_id', 'qtd_itens', 'total'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function produtos()
    {
        return $this->hasMany('App\Models\ListaProdutoCarrinho');
    }
}
