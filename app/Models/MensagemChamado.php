<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MensagemChamado extends Model
{
    protected $fillable = [
        'chamado_id',
        'usuario_id',
        'mensagem',
        'tipo_usuario',
    ];

    public function chamado(): BelongsTo
    {
        return $this->belongsTo(Chamado::class);
    }
}
