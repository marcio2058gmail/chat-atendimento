<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaFiscal extends Model
{
    protected $table = 'notas_fiscais';

    protected $fillable = [
        'cliente_id',
        'fatura_id',
        'numero_nf',
        'codigo_verificacao',
        'valor',
        'data_emissao',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'valor' => 'decimal:2',
            'data_emissao' => 'date',
        ];
    }

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_id');
    }

    public function fatura(): BelongsTo
    {
        return $this->belongsTo(Fatura::class);
    }
}
