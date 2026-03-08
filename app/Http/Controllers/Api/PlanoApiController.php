<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoApiController extends Controller
{
    public function index()
    {
        $planos = Plano::query()
            ->where('status', 'ativo')
            ->orderBy('valor_mensal')
            ->get();

        return response()->json($planos);
    }
}
