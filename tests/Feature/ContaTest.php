<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContaTest extends TestCase
{
    /** @test */
    public function criar_uma_nova_conta()
    {
        $response = $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => 234,
                'saldo' => 180.37,
            ]);
    }

    /** @test */
    public function consultar_saldo_da_conta()
    {
        // Primeiro, crie a conta
        $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37
        ]);

        $response = $this->getJson('/api/conta?numero_conta=234');

        $response->assertStatus(200)
            ->assertJson([
                'numero_conta' => 234,
                'saldo' => 180.37,
            ]);
    }

    /** @test */
    public function realizar_uma_transacao()
    {
        // Primeiro, crie a conta
        $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37
        ]);

        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => 234,
            'valor' => 10
        ]);

        // Saldo inicial: 180.37
        // Valor da transação: 10
        // Taxa de débito (3%): 0.30
        // Saldo esperado: 180.37 - 10 - 0.30 = 170.07

        $response->assertStatus(201)
            ->assertJson([
                'numero_conta' => 234,
                'saldo' => 170.07, // Saldo esperado após a transação
            ]);
    }
}
