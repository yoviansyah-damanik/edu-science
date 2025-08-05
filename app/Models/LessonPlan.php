<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LessonPlan extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

    public function scopeOwned($q)
    {
        $q->where('user_id', auth()->id());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(LessonActivity::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(LessonMaterial::class);
    }

    public function studentWorksheets(): HasManyThrough
    {
        return $this->hasManyThrough(StudentWorksheet::class, LessonMaterial::class);
    }

    public function assessments(): HasManyThrough
    {
        return $this->hasManyThrough(Assessment::class, LessonMaterial::class);
    }

    public function lessonActivities(): HasManyThrough
    {
        return $this->hasManyThrough(LessonActivity::class, LessonMaterial::class);
    }

    public function lessonAssessments(): HasManyThrough
    {
        return $this->hasManyThrough(LessonAssessment::class, LessonMaterial::class);
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(Evaluation::class);
    }

    public function teachingModule(): HasOne
    {
        return $this->hasOne(TeachingModule::class);
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class);
    }

    public function reflection(): HasOne
    {
        return $this->hasOne(Reflection::class);
    }
}
