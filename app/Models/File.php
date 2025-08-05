<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use HasUuids;

    protected $guarded = ['id'];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
