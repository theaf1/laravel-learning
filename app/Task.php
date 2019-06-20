<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'type',
        'name',
        'detail',
        'status'
    ];

    public function getTypeName(){
        switch($this->type){
            case 1 :
                return "Support";
                break;
            case 2 :
                return "Maintain";
                break;
            case 3 :
                return "Change Requirement";
                break;
            default :
                return "Unknown";
                break;
        }
    }
}
