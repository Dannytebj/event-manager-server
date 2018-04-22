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
        'name', 'address', 'capacity', 'owner_id'
    ];

    public static $rules = [
        'name' => 'required|string',
        'address' => 'required|string',
        'capacity' => 'required|integer',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
