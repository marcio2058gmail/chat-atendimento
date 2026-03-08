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
        Schema::create('atendentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente_empresas')->cascadeOnDelete();
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->string('status')->default('ativo');
            $table->timestamps();

            $table->unique(['cliente_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendentes');
    }
};
