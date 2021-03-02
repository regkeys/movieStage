<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{

    /**
     * Create a MODEL to create a relationship between the user and the NEW movie
     * So this is sayinbg that a single movie belongs to a User
     * create other side in the User Model
     */
    public function user(){
        return $this->belongsTo('App\Models\User');  //belongsToMany  or belongsTo
    }
}

// functionality available in the model
// can put relationship here
