<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    // Get the case data
    public function caseData(): HasMany
    {
        return $this->hasMany(CaseData::class);
    }
}
