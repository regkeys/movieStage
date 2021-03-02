<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**  ***********************************************************************************  UPLOAD ****************
     * Create a relationship from the User to the movie being created
     * As a user can have many movies
     * Create other side in the movie Model
     */
    public function uploads(){
        return $this->hasMany('App\Models\Upload');
    }


    /**  ***********************************************************************************  ROLE ****************
     *
     * set up relationship to Role Model
     *
     */
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }


    /**
     *
     * GATES
     * see also providers->AuthServiceProvider.php
     * see also UserController.php
     */
    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }


}
