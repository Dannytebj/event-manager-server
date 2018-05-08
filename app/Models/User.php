<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'password'
    ];

    /**
     * The validating ruleset.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'phoneNumber' => 'string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function events()
    {
        return $this->hasMany('App\Models\Events');
    }
    public function centers()
    {
        return $this->hasMany('App\Models\Center');
    }
}
