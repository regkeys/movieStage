<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    /**
     * video # 5
     * set up relationship to User Model
     *
     */
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
