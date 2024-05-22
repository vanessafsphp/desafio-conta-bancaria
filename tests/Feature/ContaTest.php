<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContaTest extends TestCase
{
    /** @test */
    public function criar_uma_nova_conta()
    {
        $dados = [
            'numero_conta' => 986,
            'saldo' => 350.50,
        ];

        $response = $this->postJson('/api/conta', $dados);

        $response
            ->assertStatus(201)
            ->assertJson([
                'numero_conta' => 986,
                'saldo' => "350,50",
            ]);
    }

    /** @test */
    public function nao_criar_conta_ja_existente()
    {
        $dados = [
            'numero_conta' => 144,
            'saldo' => 200.00,
        ];

        $response = $this->postJson('/api/conta', $dados);

        $response
            ->assertStatus(409)
            ->assertJson(['error' => 'Conta já existe']);
    }

    /** @test */
    public function consultar_saldo_da_conta()
    {
        $response = $this->getJson('/api/conta?numero_conta=234');

        $response->assertStatus(200)
            ->assertJson([
                'numero_conta' => 234,
                'saldo' => "180,37",
            ]);
    }

    /** @test */
    public function consultar_conta_inexistente()
    {
        $response = $this->getJson("/api/conta?numero_conta=28");

        $response->assertNotFound()
            ->assertJson(['error' => 'Conta não encontrada']);
    }

    /** @test */
    public function realizar_uma_transacao()
    {
        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => 234,
            'valor' => 10
        ]);

        // Saldo inicial: 180.37
        // Valor da transação: 10.00
        // Taxa de débito (3%): 0.30
        // Saldo esperado: 180.37 - 10.00 - 0.30 = "170,07"
        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => 234,
                'saldo' => "170,07", // Saldo esperado após a transação
            ]);
    }

    /** @test */
    public function nao_realizar_uma_transacao_saldo_insulficiente()
    {
        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => 153,
            'valor' => 10
        ]);

        $response->assertNotFound()
            ->assertJson(['error' => 'Saldo insuficiente']);
    }

    /** @test */
    public function nao_realizar_uma_transacao_conta_inexistente()
    {
        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => 78,
            'valor' => 10
        ]);

        $response->assertNotFound()
            ->assertJson(['error' => 'Conta não encontrada']);
    }
}
