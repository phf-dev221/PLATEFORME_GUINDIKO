<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Mentor extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public function Session()
    {
        return $this->hasMany(Session::class);
    }

    public function Article()
    {
        return $this->belongsTo(Article::class);
    }

    public function Evenement_Mentor()
    {
        return $this->hasMany(Evenement_Mentor::class);
    }

    protected $fillabe=[
        'nom',
        'telephone',
        'photo_profil',
        'nombre_annee_experience',
        'nombre_mentores',
        'role',
        'est_archive',
        'email',
        'password',
        'article_id',
    ];
}
