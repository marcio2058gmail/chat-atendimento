<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssinaturaRequest;
use App\Models\Assinatura;
use App\Models\ClienteEmpresa;
use App\Models\Plano;
use Illuminate\Http\Request;

class AssinaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assinaturas = Assinatura::query()
            ->with(['clienteEmpresa', 'plano'])
            ->latest()
            ->paginate(15);

        return view('admin.assinaturas.index', compact('assinaturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $planos = Plano::query()->orderBy('nome_plano')->get();

        return view('admin.assinaturas.create', compact('clientes', 'planos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssinaturaRequest $request)
    {
        Assinatura::create($request->validated());

        return redirect()->route('admin.assinaturas.index')->with('status', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assinatura $assinatura)
    {
        $assinatura->load(['clienteEmpresa', 'plano']);

        return view('admin.assinaturas.show', compact('assinatura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assinatura $assinatura)
    {
        $clientes = ClienteEmpresa::query()->orderBy('nome_fantasia')->get();
        $planos = Plano::query()->orderBy('nome_plano')->get();

        return view('admin.assinaturas.edit', compact('assinatura', 'clientes', 'planos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAssinaturaRequest $request, Assinatura $assinatura)
    {
        $assinatura->update($request->validated());

        return redirect()->route('admin.assinaturas.index')->with('status', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assinatura $assinatura)
    {
        $assinatura->delete();

        return redirect()->route('admin.assinaturas.index')->with('status', 'Subscription deleted successfully.');
    }
}
