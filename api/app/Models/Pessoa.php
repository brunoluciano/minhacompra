<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'id', 'nome', 'cpf', 'sexo', 'nascimento', 'telefone', 'endereco', 'numero', 'complemento', 'cidade', 'estado_id', 'bairro', 'cep'
    ];

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }
}
