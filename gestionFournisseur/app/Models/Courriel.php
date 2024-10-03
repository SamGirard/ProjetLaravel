<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courriel extends Model
{
    //use HasFactory;
    protected $fillable = ['objet', 'message', 'role'];

    protected $table = 'modele_courriel';

}


