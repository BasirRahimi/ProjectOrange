<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Executors extends Model
{
    protected $table = 'client_executors';
    protected $casts = [
        'the_data' => 'array'
    ];
}
