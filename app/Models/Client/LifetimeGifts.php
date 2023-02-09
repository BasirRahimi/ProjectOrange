<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class LifetimeGifts extends Model
{
    protected $table = 'client_lifetime_gifts';
    protected $casts = [
        'the_data' => 'array'
    ];
}
