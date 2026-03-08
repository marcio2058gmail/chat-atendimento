<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaturaRequest;
use App\Models\Assinatura;
use App\Models\ClienteEmpresa;
use App\Models\Fatura;
use Illuminate\Http\Request;

class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Fatura::class);

        $query = Fatura::query()->with(['clienteEmpresa', 'assinatura'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('cliente_id', auth()->user()->cliente_empresa_id);
        }

        $faturas = $query->paginate(15);

        return view('financeiro.faturas.index', compact('faturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Fatura::class);

        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $assinaturas = Assinatura::query()->with('plano')->latest()->get();

        return view('financeiro.faturas.create', compact('clientes', 'assinaturas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaturaRequest $request)
    {
        $this->authorize('create', Fatura::class);

        Fatura::create($request->validated());

        return redirect()->route('financeiro.faturas.index')->with('status', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fatura $fatura)
    {
        $this->authorize('view', $fatura);
        $fatura->load(['clienteEmpresa', 'assinatura.plano', 'notaFiscal']);

        return view('financeiro.faturas.show', compact('fatura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fatura $fatura)
    {
        $this->authorize('update', $fatura);

        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $assinaturas = Assinatura::query()->with('plano')->latest()->get();

        return view('financeiro.faturas.edit', compact('fatura', 'clientes', 'assinaturas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFaturaRequest $request, Fatura $fatura)
    {
        $this->authorize('update', $fatura);

        $fatura->update($request->validated());

        return redirect()->route('financeiro.faturas.index')->with('status', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fatura $fatura)
    {
        $this->authorize('delete', $fatura);

        $fatura->delete();

        return redirect()->route('financeiro.faturas.index')->with('status', 'Invoice deleted successfully.');
    }
}
