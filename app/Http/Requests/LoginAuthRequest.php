<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginAuthRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identifier' => 'required|string|size:8',

            'password' => [
                'required',
                'max:16',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'identifier.required' => 'Atenção, o campo de identificação do usuário é de preenchimento obrigatório',
            'password.required' => 'Atenção, o campo de senha é de preenchimento obrigatório',
            'identifier.size' => 'Identificação ou Senha de usuário inválida!',
            'password.*' => 'identificação ou Senha de usuário inválida!',
        ];
    }
}
