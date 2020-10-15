<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'id', 'nome', 'cnpj', 'logo_url', 'telefone', 'endereco', 'numero', 'bairro', 'cidade', 'estado_id', 'cep'
    ];

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }
}
