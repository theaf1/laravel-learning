<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientCard extends Model
{
    protected $fillable = [
        'patient_id',
        'hn',
        'date_issued'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}
