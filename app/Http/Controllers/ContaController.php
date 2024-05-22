<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContaService;

class ContaController extends Controller
{
    protected $contaService;

    public function __construct(ContaService $contaService)
    {
        $this->contaService = $contaService;
    }

    public function store(Request $request)
    {
        return $this->contaService->createConta($request->all());
    }

    public function show(Request $request)
    {
        $numeroConta = $request->query('numero_conta');
        return $this->contaService->getConta($numeroConta);
    }
}
