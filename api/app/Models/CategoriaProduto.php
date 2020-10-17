<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
{
    protected $fillable = [
        'id', 'empresa_id', 'descricao'
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
}
