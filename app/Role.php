<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    
    public function users(){
        return $this->belongsTomany(Users::class,'role_users');
    }
    public function scopeAdminOrStaff($query)
    {
        $query->where(function($sub_query){
            $sub_query->where('role_id',1)
            ->orwhere('role_id',2);
        });
    }
}