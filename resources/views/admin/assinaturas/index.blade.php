<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Subscriptions</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.assinaturas.create') }}" class="underline">New Subscription</a>
        <ul class="mt-4 bg-white shadow-sm rounded-lg divide-y">
            @foreach($assinaturas as $assinatura)
                <li class="p-4">
                    {{ $assinatura->clienteEmpresa->nome_fantasia ?? 'N/A' }} - {{ $assinatura->plano->nome_plano ?? 'N/A' }} - {{ $assinatura->status }}
                </li>
            @endforeach
        </ul>
        <div class="mt-4">{{ $assinaturas->links() }}</div>
    </div>
</x-app-layout>
