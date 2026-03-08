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
        Schema::create('cliente_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cnpj', 18)->unique();
            $table->string('email')->unique();
            $table->string('telefone', 30)->nullable();
            $table->string('endereco')->nullable();
            $table->string('cidade', 120)->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('cep', 12)->nullable();
            $table->string('status')->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_empresas');
    }
};
