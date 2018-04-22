<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['type'];

    const AVAILABLE = 1;
    const BOOKED = 2;
}