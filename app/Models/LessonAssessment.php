<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class LessonAssessment extends Model
{
    protected $guarded = ['id'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(LessonMaterial::class, 'lesson_material_id');
    }

    public function plan(): HasOneThrough
    {
        return $this->hasOneThrough(LessonPlan::class, LessonMaterial::class, 'id', 'id', 'lesson_material_id', 'lesson_plan_id');
    }
}
