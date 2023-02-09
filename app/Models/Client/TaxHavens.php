<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class TaxHavens extends Model
{
    protected $table = 'client_tax_havens';
    protected $casts = [
        'the_data' => 'array'
    ];
}
