<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMensagemChamadoRequest extends FormRequest
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
            'chamado_id' => ['required', 'exists:chamados,id'],
            'usuario_id' => ['required', 'integer', 'min:1'],
            'mensagem' => ['required', 'string'],
            'tipo_usuario' => ['required', Rule::in(['cliente', 'atendente'])],
        ];
    }
}
