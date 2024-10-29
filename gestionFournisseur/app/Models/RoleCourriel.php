<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleCourriel extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'role', 
    ];

    protected $primaryKey = 'role';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'role_courriel';

    public $timestamps = false;

}
