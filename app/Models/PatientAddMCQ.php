<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAddMCQ extends Model
{
    protected $table = 'patientAddMcqs';
    protected $fillable = [
        'etat_pam'
    ];

    public function nom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
    public function title_mcq()
    {
        return $this->belongsTo(Mcqs::class, 'id_mcq', 'id');
    }
    public function prenom_pat()
    {
        return $this->belongsTo(Patient::class, 'id_pat', 'id');
    }
}
