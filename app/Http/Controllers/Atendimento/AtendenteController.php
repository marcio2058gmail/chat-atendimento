<?php

namespace App\Http\Controllers\Atendimento;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAtendenteRequest;
use App\Models\Atendente;
use App\Models\ClienteEmpresa;
use Illuminate\Http\Request;

class AtendenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Atendente::query()->with('clienteEmpresa')->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_id', auth()->user()->cliente_empresa_id);
        }

        $atendentes = $query->paginate(15);

        return view('atendimento.atendentes.index', compact('atendentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();

        return view('atendimento.atendentes.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAtendenteRequest $request)
    {
        Atendente::create($request->validated());

        return redirect()->route('atendimento.atendentes.index')->with('status', 'Agent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atendente $atendente)
    {
        return view('atendimento.atendentes.show', compact('atendente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atendente $atendente)
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();

        return view('atendimento.atendentes.edit', compact('atendente', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAtendenteRequest $request, Atendente $atendente)
    {
        $data = $request->validated();

        if (blank($data['senha'] ?? null)) {
            unset($data['senha']);
        }

        $atendente->update($data);

        return redirect()->route('atendimento.atendentes.index')->with('status', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atendente $atendente)
    {
        $atendente->delete();

        return redirect()->route('atendimento.atendentes.index')->with('status', 'Agent deleted successfully.');
    }
}
