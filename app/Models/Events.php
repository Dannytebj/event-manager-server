<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'center_id', 'start_date', 'end_date','user_id'
    ];
    public static $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'start_date' => 'required|string',
        'end_date' => 'required|string',
        'center_id' => 'required|string',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function center()
    {
        return $this->belongsTo('App\Models\Center', 'center_id');
    }

}
