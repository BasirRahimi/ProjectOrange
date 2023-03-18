<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseData extends Model
{
    protected $casts = [
        'the_data' => 'array',
    ];
}
