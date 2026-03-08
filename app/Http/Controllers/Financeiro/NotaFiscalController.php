<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\Fatura;
use App\Models\NotaFiscal;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = NotaFiscal::query()->with(['clienteEmpresa', 'fatura'])->latest()->paginate(15);

        return view('financeiro.notas-fiscais.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faturasPagas = Fatura::query()->where('status', 'pago')->with('clienteEmpresa')->latest()->get();

        return view('financeiro.notas-fiscais.create', compact('faturasPagas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fatura_id' => ['required', 'exists:faturas,id'],
            'numero_nf' => ['nullable', 'string', 'max:120'],
            'codigo_verificacao' => ['nullable', 'string', 'max:120'],
            'valor' => ['required', 'numeric', 'min:0'],
            'data_emissao' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $fatura = Fatura::findOrFail($data['fatura_id']);

        NotaFiscal::create([
            ...$data,
            'cliente_id' => $fatura->cliente_id,
        ]);

        return redirect()->route('financeiro.notas-fiscais.index')->with('status', 'Service invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaFiscal $notaFiscal)
    {
        $nota = $notaFiscal->load(['clienteEmpresa', 'fatura']);

        return view('financeiro.notas-fiscais.show', compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaFiscal $notaFiscal)
    {
        $nota = $notaFiscal;

        return view('financeiro.notas-fiscais.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaFiscal $notaFiscal)
    {
        $data = $request->validate([
            'numero_nf' => ['nullable', 'string', 'max:120'],
            'codigo_verificacao' => ['nullable', 'string', 'max:120'],
            'valor' => ['required', 'numeric', 'min:0'],
            'data_emissao' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        $notaFiscal->update($data);

        return redirect()->route('financeiro.notas-fiscais.index')->with('status', 'Service invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaFiscal $notaFiscal)
    {
        $notaFiscal->delete();

        return redirect()->route('financeiro.notas-fiscais.index')->with('status', 'Service invoice deleted successfully.');
    }
}
