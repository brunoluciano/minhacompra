<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome', 'email', 'password', 'empresa_id', 'tipo_usuario_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function tipo_usuario()
    {
        return $this->belongsTo('App\Models\TipoUsuario');
    }
}
