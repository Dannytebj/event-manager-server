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
        'name', 'address', 'capacity', 'owner', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
