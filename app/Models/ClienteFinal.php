<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClienteFinal extends Model
{
    protected $table = 'clientes_finais';

    protected $fillable = [
        'cliente_empresa_id',
        'nome',
        'telefone',
        'email',
    ];

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_empresa_id');
    }

    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class);
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(AvaliacaoChamado::class);
    }
}
