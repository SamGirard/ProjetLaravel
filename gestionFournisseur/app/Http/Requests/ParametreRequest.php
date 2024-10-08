<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'courrielAppro' => 'required|email|min:1|max:64',
            'delai'=> 'required|integer',
            'taille'=>'required|integer',
            'courrielFinance' => 'required|email|min:1|max:64',
        ];
    }

    public function messages(){
        return [
            'courrielAppro.required' => 'Le courriel d\'approvisionnement est requis',
            'delai.required' => 'Le déali est requis',
            'taille.required' => 'La taille est requise',
            'courrielFinance.required' => 'Le courriel des finances est requis',
        ];
    }
}
