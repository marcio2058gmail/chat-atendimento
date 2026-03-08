<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClienteEmpresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'email',
        'telefone',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'status',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'cliente_empresa_id');
    }

    public function assinaturas(): HasMany
    {
        return $this->hasMany(Assinatura::class, 'cliente_id');
    }

    public function faturas(): HasMany
    {
        return $this->hasMany(Fatura::class, 'cliente_id');
    }

    public function notasFiscais(): HasMany
    {
        return $this->hasMany(NotaFiscal::class, 'cliente_id');
    }

    public function atendentes(): HasMany
    {
        return $this->hasMany(Atendente::class, 'cliente_id');
    }

    public function clientesFinais(): HasMany
    {
        return $this->hasMany(ClienteFinal::class, 'cliente_empresa_id');
    }

    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class, 'cliente_empresa_id');
    }
}
