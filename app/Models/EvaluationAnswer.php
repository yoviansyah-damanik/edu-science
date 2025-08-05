<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationAnswer extends Model
{
    protected $guarded = ['id'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(EvaluationQuestion::class, 'evaluation_question_id');
    }
}
