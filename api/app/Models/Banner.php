<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'id', 'empresa_id', 'descricao', 'imagem_url', 'ativo'
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
}
