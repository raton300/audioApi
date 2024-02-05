<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appareil extends Model
{
    protected $table = 'appareils';

    protected $fillable = [
        'modele_app', 'annee_app', 'photo_app', 'id_fab', 'id_ta'
    ];
    public function typeAppareil()
    {
        return $this->belongsTo(TypeAppareil::class, 'id_ta', 'id');
    }
    public function fabriquant()
    {
        return $this->belongsTo(Fabriquant::class, 'id_fab', 'id');
    }

}
