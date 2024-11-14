<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'neq',
        'nomEntreprise', 
        'etatDemande',
        'typeNumTelephone',
        'numeroTelephone',
        'poste',
        'email',
        'raisonRefus',
        'numeroTPS',
        'numeroTVQ',
        'conditionPaiement',
        'devise',
        'modeCommunication',
        'numCivique',
        'rue',
        'bureau',
        'ville',
        'province',
        'codePostal',
        'siteInternet',
        'regionAdministrative',
        'codeAdministratif'
    ];

    public $timestamps = true;

    public function brochures()
    {
        return $this->hasMany(Brochure::class);
    }
}