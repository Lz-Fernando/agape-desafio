<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => $this->cnpj ? preg_replace('/\D/', '', $this->cnpj) : null,
            
            'cep' => $this->cep ? preg_replace('/\D/', '', $this->cep) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'cnpj' => 'required|string|max:14',
            'rg'   => 'required|string|max:17',
            'born' => 'nullable|date',
            'observation' => 'nullable|string|max:150',
    
            'address' => 'required|string|max:40',
            'complement' => 'nullable|string|max:20',
            'neighborhood' => 'required|string|max:20',
            'cep' => 'nullable|numeric|digits:8',
            'city' => 'required|string|max:20',
            'uf' => 'required|string|max:2',

            'telephone' => 'nullable|string|max:13',
            'cellphone' => 'required|string|max:15',
        ];
    }
}
