<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <p class="text-sm text-gray-500">Active Clients</p>
                <p class="text-2xl font-bold">{{ $clientesAtivos }}</p>
            </div>
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <p class="text-sm text-gray-500">Active Subscriptions</p>
                <p class="text-2xl font-bold">{{ $assinaturasAtivas }}</p>
            </div>
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <p class="text-sm text-gray-500">Pending Invoices</p>
                <p class="text-2xl font-bold">{{ $faturasPendentes }}</p>
            </div>
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <p class="text-sm text-gray-500">Open Tickets</p>
                <p class="text-2xl font-bold">{{ $chamadosAbertos }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
