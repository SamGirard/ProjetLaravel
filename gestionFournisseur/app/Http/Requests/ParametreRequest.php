<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'courrielAppro' => 'required|email|min:1|max:64',
            'delai'=> 'required|integer|min:1',
            'taille'=>'required|integer|min:1',
            'courrielFinance' => 'required|email|min:1|max:64',
        ];
    }

    public function messages(){
        return [
            'courrielAppro.required' => 'Le courriel d\'approvisionnement est requis',
            'courrielAppro.email' => 'Veuillez entrer un courriel valide pour l\'approvisionnement',
            'delai.required' => 'Le délai est requis',
            'delai.integer' => 'Le délai doit être un nombre entier',
            'delai.min' => 'Le délai doit être au moins de 1 mois',
            'taille.required' => 'La taille est requise',
            'taille.integer' => 'La taille doit être un nombre entier',
            'taille.min' => 'La taille doit être d\'au moins 1 Mo',
            'courrielFinance.required' => 'Le courriel des finances est requis',
            'courrielFinance.email' => 'Veuillez entrer un courriel valide pour les finances',
        ];
    }
}
