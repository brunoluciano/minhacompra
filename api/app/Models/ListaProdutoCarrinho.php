<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaProdutoCarrinho extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'produto_id', 'carrinho_id', 'quantidade', 'total'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function carrinho()
    {
        return $this->belongsTo('App\Models\Carrinho');
    }
}
