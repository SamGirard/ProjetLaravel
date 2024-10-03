<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourrielRequest extends FormRequest
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
            'objet' => 'required|string|min:1|max:64',
            'message'=> 'required|string|in:Administrateur',
            'role'=>'required|string|'
        ];
    }

    public function messages(){
        return [
            'objet.required'=>'Le sujet est requis',
            'message.required'=>'Le message est requis',
            'role.required'=>'Le role est requis',
        ];
    }
}
