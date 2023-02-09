<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class LifeAssurance extends Model
{
    protected $table = 'client_life_assurance';
    protected $casts = [
        'the_data' => 'array'
    ];
}
