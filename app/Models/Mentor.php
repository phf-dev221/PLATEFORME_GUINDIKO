<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
}
