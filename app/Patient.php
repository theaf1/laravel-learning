<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'document_id',
        'gender'
    ];

    public function patientCard(){
        return $this->hasOne(PatientCard::class,'patient_id','id');
    }
}
