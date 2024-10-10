<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'courrielAppro';
    public $incrementing = false;
    protected $keyType = 'string';

    // Define which attributes are mass assignable
    protected $fillable = ['courrielAppro', 'delaiRevision', 'tailleMaxFichiers', 'courrielFinance'];

    protected $table = 'parametre';

    public $timestamps = false;
}
