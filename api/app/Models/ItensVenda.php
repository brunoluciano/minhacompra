<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensVenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'produto_id', 'venda_id', 'quantidade', 'total'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function venda()
    {
        return $this->belongsTo('App\Models\Venda');
    }
}
