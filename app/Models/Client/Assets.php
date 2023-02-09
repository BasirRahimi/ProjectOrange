<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    protected $table = 'client_assets';
    protected $casts = [
        'the_data' => 'array'
    ];
}
