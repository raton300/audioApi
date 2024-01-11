<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAppareil extends Model
{
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'id_sa', 'id_pat'
    ];

    public function stockAppareil()
    {
        return $this->belongsTo(StockAppareil::class, 'id_sa', 'id');
    }
    public function appareil()
    {
        return $this->belongsTo(Appareil::class, 'id_app', 'id')->select('id', 'modele_app');
    }

    public function nom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
    public function prenom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
}
