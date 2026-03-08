<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use Illuminate\Http\Request;

class FaturaApiController extends Controller
{
    public function index()
    {
        $query = Fatura::query()->with(['clienteEmpresa', 'assinatura'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_id', auth()->user()->cliente_empresa_id);
        }

        return response()->json($query->paginate(15));
    }

    public function show(Fatura $fatura)
    {
        abort_unless(auth()->user()->isAdmin() || auth()->user()->cliente_empresa_id === $fatura->cliente_id, 403);

        return response()->json($fatura->load(['clienteEmpresa', 'assinatura.plano', 'notaFiscal']));
    }
}
