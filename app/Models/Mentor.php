<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

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
