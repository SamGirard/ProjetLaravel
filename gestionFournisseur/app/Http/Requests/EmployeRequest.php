<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeRequest extends FormRequest
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
            'courriel' => 'required|string|email|min:1|max:64',
            'role'=> 'required|string|in:Administrateur,Responsable,Commis',
        ];
    }

    public function messages(){
        return [
            'courriel.required' => 'Le courriel est requis',
            'role.required' => 'L\'employé doit avoir un rôle',
        ];
    }
}
