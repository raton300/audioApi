<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pat');
    }

    public function filleul()
    {
        return $this->belongsTo(Patient::class, 'id_pat_filleul', 'id');
    }

    public function nameGodSon()
    {
        return $this->belongsTo(Patient::class, 'id_pat_filleul', 'id');
    }
    public function firstnameGodSon()
    {
        return $this->belongsTo(Patient::class, 'id_pat_filleul', 'id');
    }
    public function idfilleul()
    {
        return $this->belongsTo(Patient::class, 'id_pat_filleul', 'id');
    }

    public function nameGodFather()
    {
        return $this->belongsTo(Patient::class, 'id_pat_parrain', 'id');
    }
    public function firstnameGodFather()
    {
        return $this->belongsTo(Patient::class, 'id_pat_parrain', 'id');
    }
    public function idParrain()
    {
        return $this->belongsTo(Patient::class, 'id_pat_parrain', 'id');
    }
}
