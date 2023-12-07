<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement_Mentor extends Model
{
    use HasFactory;

    public function Mentor()
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function Evenement()
    {
        return $this->belongsToMany(Evenement::class);
    }
}
