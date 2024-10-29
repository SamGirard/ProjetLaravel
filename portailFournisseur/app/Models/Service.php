<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'categorie_generale' => 'array',
        'categorie_specialise' => 'array',
        'produit_services' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
