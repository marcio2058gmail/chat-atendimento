<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChamadoRequest;
use App\Models\Chamado;
use Illuminate\Http\Request;

class ChamadoApiController extends Controller
{
    public function index()
    {
        $query = Chamado::query()->with(['clienteFinal', 'atendente'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_empresa_id', auth()->user()->cliente_empresa_id);
        }

        return response()->json($query->paginate(15));
    }

    public function store(StoreChamadoRequest $request)
    {
        $data = $request->validated();

        if (! auth()->user()->isAdmin()) {
            $data['cliente_empresa_id'] = auth()->user()->cliente_empresa_id;
        }

        $chamado = Chamado::create($data);

        return response()->json($chamado, 201);
    }

    public function show(Chamado $chamado)
    {
        abort_unless(auth()->user()->isAdmin() || auth()->user()->cliente_empresa_id === $chamado->cliente_empresa_id, 403);

        return response()->json($chamado->load(['clienteEmpresa', 'clienteFinal', 'atendente', 'mensagens']));
    }
}
