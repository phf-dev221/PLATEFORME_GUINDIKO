<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    public function Evenement_Mentor()
    {
        return $this->hasMany(Evenement_Mentor::class);
    }
}
