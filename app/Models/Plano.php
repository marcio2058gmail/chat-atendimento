<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plano extends Model
{
    protected $fillable = [
        'nome_plano',
        'valor_mensal',
        'limite_atendentes',
        'limite_chamados',
        'descricao',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'valor_mensal' => 'decimal:2',
        ];
    }

    public function assinaturas(): HasMany
    {
        return $this->hasMany(Assinatura::class);
    }
}
