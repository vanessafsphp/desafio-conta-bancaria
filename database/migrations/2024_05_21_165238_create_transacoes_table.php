<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero_conta');
            $table->enum('forma_pagamento', ['P', 'C', 'D']);
            $table->decimal('valor', 15, 2); // coluna saldo do tipo decimal com 15 dígitos e 2 casas decimais
            $table->foreign('numero_conta')->references('numero_conta')->on('contas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
