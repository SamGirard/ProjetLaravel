<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courriel extends Model
{
    use HasFactory;

    protected $primaryKey = 'objet';
    public $incrementing = false;
    protected $keyType = 'string';
    //use HasFactory;
    protected $fillable = ['objet', 'message', 'role', 'raison'];

    protected $table = 'modele_courriel';

    public $timestamps = false;

}


