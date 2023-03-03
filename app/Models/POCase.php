<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CaseType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class POCase extends Model
{
    use SoftDeletes;

    protected $table = 'cases';

    // Return the case type
    public function caseType(): BelongsTo
    {
        return $this->belongsTo(CaseType::class);
    }
}
