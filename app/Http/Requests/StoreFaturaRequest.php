<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFaturaRequest extends FormRequest
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
            'assinatura_id' => ['required', 'exists:assinaturas,id'],
            'valor' => ['required', 'numeric', 'min:0'],
            'data_vencimento' => ['required', 'date'],
            'data_pagamento' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['pendente', 'pago', 'vencido'])],
            'forma_pagamento' => ['nullable', 'string', 'max:50'],
            'link_pagamento' => ['nullable', 'url', 'max:255'],
        ];
    }
}
