<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class NilRateBand extends Model
{
    protected $table = 'client_nil_rate_band';
    protected $casts = [
        'the_data' => 'array'
    ];
}
