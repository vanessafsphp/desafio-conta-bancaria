<?php

namespace App\Services;

use App\Repositories\ContaRepository;
use App\Models\Transacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TransacaoService
{
    protected $contaRepository;

    public function __construct(ContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function createTransacao(array $dados): JsonResponse
    {
        $conta = $this->contaRepository->buscarConta($dados['numero_conta']);
        if (!$conta) {
            return response()->json(['error' => 'Conta não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $taxas = ['D' => 0.03, 'C' => 0.05, 'P' => 0.00];
        $taxa = $taxas[$dados['forma_pagamento']];
        $valorTotal = $dados['valor'] + ($dados['valor'] * $taxa);

        if ($conta->saldo < $valorTotal) {
            return response()->json(['error' => 'Saldo insuficiente'], Response::HTTP_NOT_FOUND);
        }

        $this->contaRepository->atualizarSaldo($conta, -$valorTotal);

        $transacao = Transacao::create($dados);
        $transacao->conta()->associate($conta);
        $transacao->save();

        return response()->json(
            [
                'numero_conta' => $conta->numero_conta,
                'saldo' => number_format($conta->saldo, 2, ",", ".")
            ],
            Response::HTTP_CREATED
        );
    }
}
