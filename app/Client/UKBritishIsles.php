<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class UKBritishIsles extends Model
{
    protected $table = 'client_uk_british_isles';
    protected $casts = [
        'the_data' => 'array'
    ];
}
