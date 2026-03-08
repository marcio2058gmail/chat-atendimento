<?php

namespace App\Http\Controllers\Atendimento;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChamadoRequest;
use App\Models\Atendente;
use App\Models\Chamado;
use App\Models\ClienteEmpresa;
use App\Models\ClienteFinal;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Chamado::class);

        $query = Chamado::query()
            ->with(['clienteEmpresa', 'clienteFinal', 'atendente'])
            ->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_empresa_id', auth()->user()->cliente_empresa_id);
        }

        $chamados = $query->paginate(15);

        return view('atendimento.chamados.index', compact('chamados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Chamado::class);

        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $clientesFinais = ClienteFinal::query()->orderBy('nome')->get();
        $atendentes = Atendente::query()->orderBy('nome')->get();

        return view('atendimento.chamados.create', compact('clientes', 'clientesFinais', 'atendentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChamadoRequest $request)
    {
        $this->authorize('create', Chamado::class);

        Chamado::create($request->validated());

        return redirect()->route('atendimento.chamados.index')->with('status', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chamado $chamado)
    {
        $this->authorize('view', $chamado);

        $chamado->load(['clienteEmpresa', 'clienteFinal', 'atendente', 'mensagens']);

        return view('atendimento.chamados.show', compact('chamado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chamado $chamado)
    {
        $this->authorize('update', $chamado);

        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $clientesFinais = ClienteFinal::query()->orderBy('nome')->get();
        $atendentes = Atendente::query()->orderBy('nome')->get();

        return view('atendimento.chamados.edit', compact('chamado', 'clientes', 'clientesFinais', 'atendentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreChamadoRequest $request, Chamado $chamado)
    {
        $this->authorize('update', $chamado);

        $chamado->update($request->validated());

        return redirect()->route('atendimento.chamados.index')->with('status', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chamado $chamado)
    {
        $this->authorize('delete', $chamado);

        $chamado->delete();

        return redirect()->route('atendimento.chamados.index')->with('status', 'Ticket deleted successfully.');
    }
}
