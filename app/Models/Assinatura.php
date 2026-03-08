<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assinatura extends Model
{
    protected $fillable = [
        'cliente_id',
        'plano_id',
        'data_inicio',
        'data_vencimento',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'data_inicio' => 'date',
            'data_vencimento' => 'date',
        ];
    }

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_id');
    }

    public function plano(): BelongsTo
    {
        return $this->belongsTo(Plano::class);
    }

    public function faturas(): HasMany
    {
        return $this->hasMany(Fatura::class);
    }
}
