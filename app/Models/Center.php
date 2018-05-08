<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'capacity', 'owner_id', 'description'
    ];

    public static $rules = [
        'name' => 'required|string',
        'address' => 'required|string',
        'description' => 'required|string',
        'capacity' => 'required|integer',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function events()
    {
        return $this->belongsToMany('App\Models\Events');
    }

}
