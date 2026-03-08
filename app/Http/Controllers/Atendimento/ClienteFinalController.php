<?php

namespace App\Http\Controllers\Atendimento;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteFinalRequest;
use App\Models\ClienteEmpresa;
use App\Models\ClienteFinal;
use Illuminate\Http\Request;

class ClienteFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ClienteFinal::query()->with('clienteEmpresa')->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_empresa_id', auth()->user()->cliente_empresa_id);
        }

        $clientesFinais = $query->paginate(15);

        return view('atendimento.clientes-finais.index', compact('clientesFinais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();

        return view('atendimento.clientes-finais.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteFinalRequest $request)
    {
        ClienteFinal::create($request->validated());

        return redirect()->route('atendimento.clientes-finais.index')->with('status', 'End customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClienteFinal $clienteFinal)
    {
        return view('atendimento.clientes-finais.show', compact('clienteFinal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteFinal $clienteFinal)
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();

        return view('atendimento.clientes-finais.edit', [
            'clienteFinal' => $clienteFinal,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClienteFinalRequest $request, ClienteFinal $clienteFinal)
    {
        $clienteFinal->update($request->validated());

        return redirect()->route('atendimento.clientes-finais.index')->with('status', 'End customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteFinal $clienteFinal)
    {
        $clienteFinal->delete();

        return redirect()->route('atendimento.clientes-finais.index')->with('status', 'End customer deleted successfully.');
    }
}
