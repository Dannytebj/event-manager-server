<?php

namespace App;

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
        $this->belongsTo('App\Models\User');
    }

}
