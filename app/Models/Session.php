<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function Mentor()
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillabe=[
        'mentors_id',
        'users_id',
        'lieu',
        'en_ligne',
        'theme',
        'est_archive',
        'libelle',
    ];
}
