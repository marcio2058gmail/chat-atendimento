<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvaliacaoChamado extends Model
{
    protected $fillable = [
        'chamado_id',
        'cliente_final_id',
        'nota',
        'comentario',
    ];

    public function chamado(): BelongsTo
    {
        return $this->belongsTo(Chamado::class);
    }

    public function clienteFinal(): BelongsTo
    {
        return $this->belongsTo(ClienteFinal::class);
    }
}
