<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table    = 'users';
    protected $fillable = [
        'name', 'email','company','phone_number','subject','message'
    ];

    

  
}
