<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfosRbq extends Model
{
    use HasFactory;
    protected $table = 'infos_rbq';
    protected $primaryKey = 'numLicense';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'numLicense',
        'neqFournisseur',
        'courrielFournisseur',
        'statut',
        'typeLicense',
        'Catégorie',
        'codeSousCatégorie',
        'travauxPermis'
    ];

    public $timestamps = true;


    //relation avec fournisseurs
    public function fournisseurs(){
        return $this->hasMany(Fournisseurs::class, 'num_rbq', 'numLicense');
    }
}
