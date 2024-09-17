<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employe extends Authenticatable
{
    use HasFactory;
    protected $table = 'employes';
    protected $primaryKey = 'courriel';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['courriel', 'role'];

    public $timestamps = true;

    public function getAuthIdentifierName()
    {
        return 'courriel';
    }

    // Si vous n'utilisez pas de mot de passe, vous pouvez ignorer cette méthode ou la laisser vide
    public function getAuthPassword()
    {
        return null; // ou une valeur vide
    }
}
