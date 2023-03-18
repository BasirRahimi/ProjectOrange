<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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
    public function caseData($section)
    {
        $case_datas = $this->hasMany(CaseData::class, 'case_id');
        if (isset($section)) {
            return $case_datas->where('section', $section)->first();
        } else {
            return $case_datas;
        }
    }
}
