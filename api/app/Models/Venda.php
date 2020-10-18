<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'id', 'cliente_id', 'empresa_id', 'funcionario_id', 'entregador_id', 'status_id', 'horario', 'qtd_itens', 'total_venda'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function entregador()
    {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function status_venda()
    {
        return $this->belongsTo('App\Models\StatusVenda');
    }
}
