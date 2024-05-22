<?php

namespace App\Repositories;

use App\Models\Conta;

class ContaRepository
{
    public function criarConta($dados): Conta
    {
        return Conta::create($dados);
    }

    public function buscarConta(int $numeroConta): ?Conta
    {
        return Conta::where('numero_conta', $numeroConta)->first();
    }

    public function atualizarSaldo(Conta $conta, float $valor): bool
    {
        $conta->saldo += $valor;
        return $conta->save();
    }
}
