<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssinaturaRequest extends FormRequest
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
            'cliente_id' => ['required', 'exists:cliente_empresas,id'],
            'plano_id' => ['required', 'exists:planos,id'],
            'data_inicio' => ['required', 'date'],
            'data_vencimento' => ['required', 'date', 'after_or_equal:data_inicio'],
            'status' => ['required', Rule::in(['ativa', 'suspensa', 'cancelada'])],
        ];
    }
}
