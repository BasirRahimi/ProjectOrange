<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class ReceivedInheritance extends Model
{
    protected $table = 'client_received_inheritance';
    protected $casts = [
        'the_data' => 'array'
    ];
}
