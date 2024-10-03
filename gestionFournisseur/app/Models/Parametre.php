<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'courrielAppro', 
        'delai',
        'taille',
        'courrielFinance',
    ];

    protected $table = 'parametre';

    public $timestamps = true;
}
