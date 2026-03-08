<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_empresa_id' => ['required', 'exists:cliente_empresas,id'],
            'cliente_final_id' => ['required', 'exists:clientes_finais,id'],
            'atendente_id' => ['nullable', 'exists:atendentes,id'],
            'assunto' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'status' => ['required', Rule::in(['aberto', 'em_atendimento', 'finalizado'])],
            'prioridade' => ['required', Rule::in(['baixa', 'media', 'alta'])],
        ];
    }
}
