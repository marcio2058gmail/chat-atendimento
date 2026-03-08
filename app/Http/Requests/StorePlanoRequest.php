<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlanoRequest extends FormRequest
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
            'nome_plano' => ['required', 'string', 'max:120'],
            'valor_mensal' => ['required', 'numeric', 'min:0'],
            'limite_atendentes' => ['required', 'integer', 'min:1'],
            'limite_chamados' => ['required', 'integer', 'min:1'],
            'descricao' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['ativo', 'inativo'])],
        ];
    }
}
