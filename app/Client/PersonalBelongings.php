<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class PersonalBelongings extends Model
{
    protected $table = 'client_personal_belongings';
    protected $casts = [
        'the_data' => 'array'
    ];
}
