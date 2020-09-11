<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class PowersOfAttorney extends Model
{
    protected $table = 'client_powers_of_attorney';
    protected $casts = [
        'the_data' => 'array'
    ];
}
