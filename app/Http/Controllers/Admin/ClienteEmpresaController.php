<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteEmpresaRequest;
use App\Models\ClienteEmpresa;
use Illuminate\Http\Request;

class ClienteEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ClienteEmpresa::class);

        $clientes = ClienteEmpresa::query()->latest()->paginate(15);

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', ClienteEmpresa::class);

        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteEmpresaRequest $request)
    {
        $this->authorize('create', ClienteEmpresa::class);

        ClienteEmpresa::create($request->validated());

        return redirect()->route('admin.clientes.index')->with('status', 'Client company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClienteEmpresa $cliente)
    {
        $this->authorize('view', $cliente);

        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteEmpresa $cliente)
    {
        $this->authorize('update', $cliente);

        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClienteEmpresaRequest $request, ClienteEmpresa $cliente)
    {
        $this->authorize('update', $cliente);

        $cliente->update($request->validated());

        return redirect()->route('admin.clientes.index')->with('status', 'Client company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteEmpresa $cliente)
    {
        $this->authorize('delete', $cliente);

        $cliente->delete();

        return redirect()->route('admin.clientes.index')->with('status', 'Client company deleted successfully.');
    }
}
