<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Trusts extends Model
{
    protected $table = 'client_trusts';
    protected $casts = [
        'the_data' => 'array'
    ];
}
