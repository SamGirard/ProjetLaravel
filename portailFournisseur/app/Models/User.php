<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];
    protected $casts = [
        'typeNumTelephone' => 'array',
        'numeroTelephone' => 'array',
        'poste' => 'array'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function brochures()
    {
        return $this->hasMany(Brochure::class);
    }

    public function Contact()
    {
        return $this->hasMany(Contact::class);
    }
    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function coordonnee()
    {
        return $this->hasOne(User::class);
    }
}
