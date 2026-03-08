<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Fatura extends Model
{
    protected $fillable = [
        'cliente_id',
        'assinatura_id',
        'valor',
        'data_vencimento',
        'data_pagamento',
        'status',
        'forma_pagamento',
        'link_pagamento',
    ];

    protected function casts(): array
    {
        return [
            'valor' => 'decimal:2',
            'data_vencimento' => 'date',
            'data_pagamento' => 'date',
        ];
    }

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_id');
    }

    public function assinatura(): BelongsTo
    {
        return $this->belongsTo(Assinatura::class);
    }

    public function notaFiscal(): HasOne
    {
        return $this->hasOne(NotaFiscal::class);
    }
}
