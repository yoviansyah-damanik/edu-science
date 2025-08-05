<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonMaterialCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function lessonMaterial(): BelongsTo
    {
        return $this->belongsTo(LessonMaterial::class);
    }
}
