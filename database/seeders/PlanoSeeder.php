<?php

namespace Database\Seeders;

use App\Models\Plano;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plano::insert([
            [
                'nome_plano' => 'Starter',
                'valor_mensal' => 99.90,
                'limite_atendentes' => 3,
                'limite_chamados' => 300,
                'descricao' => 'Plan for small teams starting operation.',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_plano' => 'Professional',
                'valor_mensal' => 249.90,
                'limite_atendentes' => 10,
                'limite_chamados' => 2000,
                'descricao' => 'Plan for growing support operations.',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_plano' => 'Enterprise',
                'valor_mensal' => 799.90,
                'limite_atendentes' => 100,
                'limite_chamados' => 50000,
                'descricao' => 'High scale plan with priority support.',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
