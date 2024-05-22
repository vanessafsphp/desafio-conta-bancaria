<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransacaoService;

class TransacaoController extends Controller
{
    protected $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function store(Request $request)
    {
        return $this->transacaoService->createTransacao($request->all());
    }
}
