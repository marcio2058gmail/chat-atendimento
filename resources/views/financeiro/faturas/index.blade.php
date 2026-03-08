<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('financeiro.faturas.create') }}" class="underline">New Invoice</a>
        <ul class="mt-4 bg-white shadow-sm rounded-lg divide-y">
            @foreach($faturas as $fatura)
                <li class="p-4">
                    #{{ $fatura->id }} - {{ $fatura->clienteEmpresa->nome_fantasia ?? 'N/A' }} - {{ $fatura->status }} - R$ {{ number_format($fatura->valor, 2, ',', '.') }}
                </li>
            @endforeach
        </ul>
        <div class="mt-4">{{ $faturas->links() }}</div>
    </div>
</x-app-layout>
