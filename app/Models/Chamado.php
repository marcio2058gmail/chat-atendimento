<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chamado extends Model
{
    protected $fillable = [
        'cliente_empresa_id',
        'cliente_final_id',
        'atendente_id',
        'assunto',
        'descricao',
        'status',
        'prioridade',
    ];

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_empresa_id');
    }

    public function clienteFinal(): BelongsTo
    {
        return $this->belongsTo(ClienteFinal::class);
    }

    public function atendente(): BelongsTo
    {
        return $this->belongsTo(Atendente::class);
    }

    public function mensagens(): HasMany
    {
        return $this->hasMany(MensagemChamado::class);
    }

    public function avaliacao(): HasOne
    {
        return $this->hasOne(AvaliacaoChamado::class);
    }
}
