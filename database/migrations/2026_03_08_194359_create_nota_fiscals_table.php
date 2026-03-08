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
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente_empresas')->cascadeOnDelete();
            $table->foreignId('fatura_id')->constrained('faturas')->cascadeOnDelete();
            $table->string('numero_nf')->nullable();
            $table->string('codigo_verificacao')->nullable();
            $table->decimal('valor', 10, 2);
            $table->date('data_emissao')->nullable();
            $table->string('status')->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_fiscais');
    }
};
