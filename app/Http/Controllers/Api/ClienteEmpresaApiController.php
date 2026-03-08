<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClienteEmpresa;
use Illuminate\Http\Request;

class ClienteEmpresaApiController extends Controller
{
    public function index()
    {
        $query = ClienteEmpresa::query()->latest();

        if (! auth()->user()->isAdmin()) {
            $query->whereKey(auth()->user()->cliente_empresa_id);
        }

        return response()->json($query->paginate(15));
    }

    public function show(ClienteEmpresa $cliente)
    {
        abort_unless(auth()->user()->isAdmin() || auth()->user()->cliente_empresa_id === $cliente->id, 403);

        return response()->json($cliente->loadCount(['atendentes', 'chamados', 'faturas']));
    }
}
