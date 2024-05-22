<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    protected $table = "transacoes";

    protected $fillable = [
        'numero_conta',
        'forma_pagamento',
        'valor'
    ];

    public function conta()
    {
        return $this->belongsTo(Conta::class, 'numero_conta', 'numero_conta');
    }
}
