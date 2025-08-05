<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    protected $guarded = ['id'];

    public function answers(): HasMany
    {
        return $this->hasMany(EvaluationAnswer::class);
    }

    public function lessonPlan(): BelongsTo
    {
        return $this->belongsTo(LessonPlan::class);
    }
}
