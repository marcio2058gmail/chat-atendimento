<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanoRequest;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planos = Plano::query()->latest()->paginate(15);

        return view('admin.planos.index', compact('planos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.planos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanoRequest $request)
    {
        Plano::create($request->validated());

        return redirect()->route('admin.planos.index')->with('status', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plano $plano)
    {
        return view('admin.planos.show', compact('plano'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plano $plano)
    {
        return view('admin.planos.edit', compact('plano'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlanoRequest $request, Plano $plano)
    {
        $plano->update($request->validated());

        return redirect()->route('admin.planos.index')->with('status', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plano $plano)
    {
        $plano->delete();

        return redirect()->route('admin.planos.index')->with('status', 'Plan deleted successfully.');
    }
}
