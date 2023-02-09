<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class JointHeldAssets extends Model
{
    protected $table = 'client_joint_held_assets';
    protected $casts = [
        'the_data' => 'array'
    ];
}
