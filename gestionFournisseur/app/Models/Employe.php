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

    public function getAuthPassword()
    {
        return null;
    }
}
