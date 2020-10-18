<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocaoProduto extends Model
{
    protected $fillable = [
        'id', 'produto_id', 'porcentagem', 'novo_preco'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
