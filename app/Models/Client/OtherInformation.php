<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class OtherInformation extends Model
{
    protected $table = 'client_other_information';
    protected $casts = [
        'the_data' => 'array'
    ];
}
