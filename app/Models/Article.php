<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function Mentor()
    {
        return $this->hasMany(Mentor::class);
    }
    protected $fillable = [
        'libelle',
        'description',
        'debouche',
        'date_publication',
        'image',
        'est_archive',
    ];


    
}
