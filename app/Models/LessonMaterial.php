<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonMaterial extends Model
{
    use Sluggable;

    protected $guarded = ['id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): HasOne
    {
        return $this->hasOne(LessonMaterialCategory::class, 'id', 'lesson_material_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(LessonPlan::class);
    }

    public function worksheet(): HasOne
    {
        return $this->hasOne(StudentWorksheet::class);
    }

    public function activity(): HasOne
    {
        return $this->hasOne(LessonActivity::class);
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(LessonAssessment::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
