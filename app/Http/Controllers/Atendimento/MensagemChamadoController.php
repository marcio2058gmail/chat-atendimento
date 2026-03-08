<?php

namespace App\Http\Controllers\Atendimento;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMensagemChamadoRequest;
use App\Models\Chamado;
use App\Models\MensagemChamado;
use Illuminate\Http\Request;

class MensagemChamadoController extends Controller
{
    public function store(StoreMensagemChamadoRequest $request)
    {
        $chamado = Chamado::findOrFail($request->validated()['chamado_id']);
        $this->authorize('update', $chamado);

        MensagemChamado::create($request->validated());

        return redirect()->route('atendimento.chamados.show', $chamado)->with('status', 'Message sent successfully.');
    }
}
