<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Atendente extends Model
{
    protected $fillable = [
        'cliente_id',
        'nome',
        'email',
        'senha',
        'status',
    ];

    protected $hidden = [
        'senha',
    ];

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
        ];
    }

    public function clienteEmpresa(): BelongsTo
    {
        return $this->belongsTo(ClienteEmpresa::class, 'cliente_id');
    }

    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class);
    }
}
