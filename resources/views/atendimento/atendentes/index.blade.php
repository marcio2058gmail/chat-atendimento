<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Agents</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('atendimento.atendentes.create') }}" class="underline">New Agent</a>
        <ul class="mt-4 bg-white shadow-sm rounded-lg divide-y">
            @foreach($atendentes as $atendente)
                <li class="p-4">{{ $atendente->nome }} - {{ $atendente->email }} - {{ $atendente->status }}</li>
            @endforeach
        </ul>
        <div class="mt-4">{{ $atendentes->links() }}</div>
    </div>
</x-app-layout>
