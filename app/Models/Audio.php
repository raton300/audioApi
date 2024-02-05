<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable=[
        'nom_aud','prenom_aud','telephone_aud','photo_aud','email_aud','id_ca'
    ];
    public function centreAudio()
    {
        return $this->belongsTo(CentreAudio::class, 'id_ca', 'id');
    }
}
