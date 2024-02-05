<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable=[
        'id','start_cal','end_cal','backgroundColor','id_pat','categorie_cal','description_cal','etat_cal'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pat');
    }
}
