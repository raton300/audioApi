<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $fillable = [
        'nom_pat', 'prenom_pat', 'telephone_pat', 'dernierRDV_pat', 'assurance_pat', 'audio_id','id_app','id_ca','date_pat','adresse_pat','mail_pat','cp_pat','ville_pat','sexe_pat','ss_pat'
    ];

    public function audio()
    {
        return $this->belongsTo(Audio::class, 'audio_id', 'id');
    }
    public function appareil()
    {
        return $this->belongsTo(Appareil::class, 'id_app', 'id');
    }
    public function centreAudio()
    {
        return $this->belongsTo(Appareil::class, 'id_ca', 'id');
    }
    public function calendar()
    {
        return $this->hasMany(Calendar::class, 'id_pat');
    }
    public function fabriquant()
    {
        return $this->belongsTo(Fabriquant::class, 'id_fab', 'id');
    }
    public function typeAppareil()
    {
        return $this->belongsTo(TypeAppareil::class, 'id_ta', 'id');
    }
}
