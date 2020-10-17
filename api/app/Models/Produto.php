<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'id', 'descricao', 'empresa_id', 'departamento_id', 'categoria_id', 'marca_id', 'unidade_medida_id', 'unidade', 'cod_barras', 'estoque_minimo', 'estoque_atual', 'estoque_maximo', 'preco', 'imagem_url', 'promocao_ativa'
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Models\DepartamentoProduto');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\CategoriaProduto');
    }

    public function marca()
    {
        return $this->belongsTo('App\Models\MarcaProduto');
    }

    public function unidade_medida()
    {
        return $this->belongsTo('App\Models\UnidadeMedidaProduto');
    }
}
