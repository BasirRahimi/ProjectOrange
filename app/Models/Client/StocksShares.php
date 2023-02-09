<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class StocksShares extends Model
{
    protected $table = 'client_stocks_shares';
    protected $casts = [
        'the_data' => 'array'
    ];
}
