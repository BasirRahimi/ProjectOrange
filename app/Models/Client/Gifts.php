<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Gifts extends Model
{
    protected $table = 'client_gifts';
    protected $casts = [
        'the_data' => 'array'
    ];
}
