<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Client Companies</h2></x-slot>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.clientes.create') }}" class="underline">New Client</a>
        <div class="mt-4 bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead><tr><th class="p-3 text-left">Name</th><th class="p-3 text-left">CNPJ</th><th class="p-3 text-left">Status</th></tr></thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-t">
                            <td class="p-3">{{ $cliente->nome_fantasia }}</td>
                            <td class="p-3">{{ $cliente->cnpj }}</td>
                            <td class="p-3">{{ $cliente->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $clientes->links() }}</div>
    </div>
</x-app-layout>
