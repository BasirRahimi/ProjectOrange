<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class Pensions extends Model
{
    protected $table = 'client_pensions';
    protected $casts = [
        'the_data' => 'array'
    ];
}
