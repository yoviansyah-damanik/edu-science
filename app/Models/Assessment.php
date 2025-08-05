<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $guarded = ['id'];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(LessonPlan::class);
    }
}
