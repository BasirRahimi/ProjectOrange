<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class BusinessInterests extends Model
{
    protected $table = 'client_business_interests';
    protected $casts = [
        'the_data' => 'array'
    ];
}
