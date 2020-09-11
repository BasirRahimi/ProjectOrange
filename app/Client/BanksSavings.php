<?php

namespace App\Client;

use Illuminate\Database\Eloquent\Model;

class BanksSavings extends Model
{
    protected $table = 'client_banks_savings';
    protected $casts = [
        'the_data' => 'array'
    ];
}
