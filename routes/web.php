<?php

use App\Http\Controllers\Admin\AssinaturaController;
use App\Http\Controllers\Admin\ClienteEmpresaController;
use App\Http\Controllers\Admin\PlanoController;
use App\Http\Controllers\Atendimento\AtendenteController;
use App\Http\Controllers\Atendimento\ChamadoController;
use App\Http\Controllers\Atendimento\ClienteFinalController;
use App\Http\Controllers\Atendimento\MensagemChamadoController;
use App\Http\Controllers\Financeiro\FaturaController;
use App\Http\Controllers\Financeiro\NotaFiscalController;
use App\Http\Controllers\ProfileController;
use App\Models\Assinatura;
use App\Models\Chamado;
use App\Models\ClienteEmpresa;
use App\Models\Fatura;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard', [
        'clientesAtivos' => ClienteEmpresa::query()->where('status', 'ativo')->count(),
        'assinaturasAtivas' => Assinatura::query()->where('status', 'ativa')->count(),
        'faturasPendentes' => Fatura::query()->where('status', 'pendente')->count(),
        'chamadosAbertos' => Chamado::query()->whereIn('status', ['aberto', 'em_atendimento'])->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('clientes', ClienteEmpresaController::class)->parameters(['clientes' => 'cliente']);
        Route::resource('planos', PlanoController::class);
        Route::resource('assinaturas', AssinaturaController::class);
    });

    Route::prefix('financeiro')->name('financeiro.')->group(function () {
        Route::resource('faturas', FaturaController::class);
        Route::resource('notas-fiscais', NotaFiscalController::class)->parameters(['notas-fiscais' => 'notaFiscal']);
    });

    Route::prefix('atendimento')->name('atendimento.')->group(function () {
        Route::resource('atendentes', AtendenteController::class);
        Route::resource('clientes-finais', ClienteFinalController::class)->parameters(['clientes-finais' => 'clienteFinal']);
        Route::resource('chamados', ChamadoController::class);
        Route::post('mensagens', [MensagemChamadoController::class, 'store'])->name('mensagens.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
