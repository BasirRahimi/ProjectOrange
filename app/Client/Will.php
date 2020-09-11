<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class Will extends Model
{
    protected $table = 'client_will';
    protected $casts = [
        'the_data' => 'array'
    ];
}
