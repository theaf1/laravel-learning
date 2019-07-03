<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'type_id',
        'name',
        'detail',
        'status',
        'user_id'
    ];

    public function getTypeName(){
        switch($this->type_id){
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

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
