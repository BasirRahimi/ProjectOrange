<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class Liabilities extends Model
{
    protected $table = 'client_liabilities';
    protected $casts = [
        'the_data' => 'array'
    ];
}
