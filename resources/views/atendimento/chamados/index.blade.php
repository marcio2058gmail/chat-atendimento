<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tickets Panel</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('atendimento.chamados.create') }}" class="underline">New Ticket</a>
        <ul class="mt-4 bg-white shadow-sm rounded-lg divide-y">
            @foreach($chamados as $chamado)
                <li class="p-4 flex justify-between">
                    <span>#{{ $chamado->id }} - {{ $chamado->assunto }} ({{ $chamado->status }})</span>
                    <a class="underline" href="{{ route('atendimento.chamados.show', $chamado) }}">Open Chat</a>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">{{ $chamados->links() }}</div>
    </div>
</x-app-layout>
