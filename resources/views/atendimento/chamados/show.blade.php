<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Ticket Chat #{{ $chamado->id }}</h2></x-slot>
    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <p><strong>Subject:</strong> {{ $chamado->assunto }}</p>
            <p><strong>Description:</strong> {{ $chamado->descricao }}</p>
            <p><strong>Status:</strong> {{ $chamado->status }}</p>
        </div>

        <div class="mt-4 bg-white p-4 rounded-lg shadow-sm space-y-3">
            @forelse($chamado->mensagens as $mensagem)
                <div class="border rounded p-3">
                    <p class="text-xs text-gray-500">{{ $mensagem->tipo_usuario }} #{{ $mensagem->usuario_id }} - {{ $mensagem->created_at }}</p>
                    <p>{{ $mensagem->mensagem }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-500">No messages yet.</p>
            @endforelse
        </div>

        <form action="{{ route('atendimento.mensagens.store') }}" method="POST" class="mt-4 bg-white p-4 rounded-lg shadow-sm">
            @csrf
            <input type="hidden" name="chamado_id" value="{{ $chamado->id }}">
            <div>
                <label class="block text-sm">User ID</label>
                <input name="usuario_id" class="border rounded w-full" value="{{ auth()->id() }}">
            </div>
            <div class="mt-3">
                <label class="block text-sm">User Type</label>
                <select name="tipo_usuario" class="border rounded w-full">
                    <option value="atendente">atendente</option>
                    <option value="cliente">cliente</option>
                </select>
            </div>
            <div class="mt-3">
                <label class="block text-sm">Message</label>
                <textarea name="mensagem" class="border rounded w-full" rows="4"></textarea>
            </div>
            <button class="mt-3 px-4 py-2 bg-black text-white rounded">Send</button>
        </form>
    </div>
</x-app-layout>
