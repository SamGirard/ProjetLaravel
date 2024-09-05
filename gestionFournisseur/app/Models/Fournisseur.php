<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    // Spécifiez la clé primaire
    protected $primaryKey = 'neq';
    // Indique que la clé primaire n'est pas auto-incrémentée
    public $incrementing = false;
    // Assurez-vous que la clé primaire est de type string
    protected $keyType = 'string';


    protected $table = 'fournisseurs';

    protected $fillable = [
        'neq',
        'courriel',
        'password',
        'nomEntreprise',
        'num_rbq',
        'numCivique',
        'rue',
        'bureau',
        'ville',
        'province',
        'codePostal',
        'siteInternet',
        'régionAdministrative',
        'TypeNumTelephone',
        'numéroTelephone',
        'poste',
        'courrielContact',
        'numTPS',
        'numTVQ',
        'conditionPaiement',
        'devise',
        'modeCommunication'
    ];

    public $timestamps = true;

    //relation avec info_rbq
    public function infosRbq(){
        return $this->belongsTo(infosRbq::class, 'num_rbq', 'numLicense');
    }
}
