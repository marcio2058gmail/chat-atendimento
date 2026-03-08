<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAtendenteRequest extends FormRequest
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
        $atendente = $this->route('atendente');

        return [
            'cliente_id' => ['required', 'exists:cliente_empresas,id'],
            'nome' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('atendentes', 'email')->where(fn ($query) => $query->where('cliente_id', $this->input('cliente_id')))->ignore($atendente),
            ],
            'senha' => [$atendente ? 'nullable' : 'required', 'string', 'min:6'],
            'status' => ['required', Rule::in(['ativo', 'inativo'])],
        ];
    }
}
