<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $casts = [
        'executors' => 'array',
        'powers_of_attorney' => 'array'
    ];

}
