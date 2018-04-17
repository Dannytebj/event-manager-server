<?php

namespace App;

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
        'name', 'email', 'phone_number'
    ];

    /**
     * The validating ruleset.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'phone_number' => 'string'
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
        $this->hasMany('App\Models\Event');
    }
    public function centers()
    {
        $this->hasMany('App\Models\Center');
    }
}
