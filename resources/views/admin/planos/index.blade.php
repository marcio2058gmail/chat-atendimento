<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Plans</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.planos.create') }}" class="underline">New Plan</a>
        <ul class="mt-4 bg-white shadow-sm rounded-lg divide-y">
            @foreach($planos as $plano)
                <li class="p-4 flex justify-between">
                    <span>{{ $plano->nome_plano }}</span>
                    <span>R$ {{ number_format($plano->valor_mensal, 2, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">{{ $planos->links() }}</div>
    </div>
</x-app-layout>
