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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_empresa_id')->constrained('cliente_empresas')->cascadeOnDelete();
            $table->foreignId('cliente_final_id')->constrained('clientes_finais')->cascadeOnDelete();
            $table->foreignId('atendente_id')->nullable()->constrained('atendentes')->nullOnDelete();
            $table->string('assunto');
            $table->text('descricao');
            $table->string('status')->default('aberto');
            $table->string('prioridade')->default('media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
