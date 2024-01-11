<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAppareil extends Model
{
    protected $fillable = [
        'numero_serie', 'cabinet', 'id_fab'
    ];

    public function nom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
    public function prenom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
    public function modele_app()
    {
        return $this->belongsTo(Appareil::class, 'id_app', 'id');
    }
    public function appareil()
    {
        return $this->belongsTo(Appareil::class, 'id_app', 'id')->with('fabriquant:id,nom_fab');
    }

}
