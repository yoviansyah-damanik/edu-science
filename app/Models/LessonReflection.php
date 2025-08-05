<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonReflection extends Model
{
    protected $guarded = ['id'];

    public function lessonPlan(): BelongsTo
    {
        return $this->belongsTo(LessonPlan::class);
    }
}
