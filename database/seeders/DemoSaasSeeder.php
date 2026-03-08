<?php

namespace Database\Seeders;

use App\Models\Assinatura;
use App\Models\Atendente;
use App\Models\Chamado;
use App\Models\ClienteEmpresa;
use App\Models\ClienteFinal;
use App\Models\Fatura;
use App\Models\MensagemChamado;
use App\Models\Plano;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSaasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = ClienteEmpresa::create([
            'razao_social' => 'ACME Suporte LTDA',
            'nome_fantasia' => 'ACME Support',
            'cnpj' => '12.345.678/0001-90',
            'email' => 'contato@acme.test',
            'telefone' => '(11) 90000-0000',
            'endereco' => 'Rua Exemplo, 100',
            'cidade' => 'Sao Paulo',
            'estado' => 'SP',
            'cep' => '01000-000',
            'status' => 'ativo',
        ]);

        $plano = Plano::query()->where('nome_plano', 'Professional')->firstOrFail();

        $assinatura = Assinatura::create([
            'cliente_id' => $cliente->id,
            'plano_id' => $plano->id,
            'data_inicio' => now()->toDateString(),
            'data_vencimento' => now()->addMonth()->toDateString(),
            'status' => 'ativa',
        ]);

        $fatura = Fatura::create([
            'cliente_id' => $cliente->id,
            'assinatura_id' => $assinatura->id,
            'valor' => $plano->valor_mensal,
            'data_vencimento' => now()->addDays(7)->toDateString(),
            'status' => 'pendente',
            'forma_pagamento' => 'pix',
            'link_pagamento' => 'https://pay.example.com/invoice/demo-001',
        ]);

        $gestor = User::create([
            'name' => 'Tenant Manager',
            'email' => 'manager@acme.test',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'cliente_empresa_id' => $cliente->id,
        ]);

        $atendente = Atendente::create([
            'cliente_id' => $cliente->id,
            'nome' => 'Alice Agent',
            'email' => 'alice.agent@acme.test',
            'senha' => 'password',
            'status' => 'ativo',
        ]);

        $clienteFinal = ClienteFinal::create([
            'cliente_empresa_id' => $cliente->id,
            'nome' => 'Carlos Silva',
            'telefone' => '(11) 98888-7777',
            'email' => 'carlos@cliente.test',
        ]);

        $chamado = Chamado::create([
            'cliente_empresa_id' => $cliente->id,
            'cliente_final_id' => $clienteFinal->id,
            'atendente_id' => $atendente->id,
            'assunto' => 'Cannot access billing area',
            'descricao' => 'Customer reports login loop on billing section.',
            'status' => 'em_atendimento',
            'prioridade' => 'alta',
        ]);

        MensagemChamado::create([
            'chamado_id' => $chamado->id,
            'usuario_id' => $clienteFinal->id,
            'mensagem' => 'I cannot download my latest invoice.',
            'tipo_usuario' => 'cliente',
        ]);

        MensagemChamado::create([
            'chamado_id' => $chamado->id,
            'usuario_id' => $atendente->id,
            'mensagem' => 'We are checking this issue and will update in a few minutes.',
            'tipo_usuario' => 'atendente',
        ]);

        // Keep references used by future modules and demo scripts.
        $fatura->refresh();
        $gestor->refresh();
    }
}
