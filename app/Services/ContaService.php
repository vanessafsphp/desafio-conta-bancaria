<?php

namespace App\Services;

use App\Models\Conta;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\ContaRepository;

class ContaService
{
    protected $contaRepository;

    public function __construct(ContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function createConta(array $dados): JsonResponse
    {

        $contaExistente = $this->validated($dados['numero_conta']);
        if ($contaExistente) {
            return response()->json(['error' => 'Conta já existe'], Response::HTTP_CONFLICT);
        }

        $conta = $this->contaRepository->criarConta($dados);
        return response()->json([
            'numero_conta' => $conta->numero_conta,
            'saldo' => number_format($conta->saldo, 2, ",", "."),
        ], Response::HTTP_CREATED);
    }

    public function getConta(int $numeroConta): JsonResponse
    {
        $conta = $this->validated($numeroConta);
        if (!$conta) {
            return response()->json(['error' => 'Conta não encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'numero_conta' => $conta->numero_conta,
            'saldo' => number_format($conta->saldo, 2, ",", "."),
        ], Response::HTTP_OK);
    }

    public function validated(int $numeroConta): ?Conta
    {
        return $this->contaRepository->buscarConta($numeroConta);
    }
}
