<?php

namespace App\Livewire\LessonActivity;

use App\Models\LessonActivity;
use App\Models\LessonMaterial;
use App\Models\LessonPlan;
use Livewire\Component;

class Show extends Component
{
    public LessonPlan  $lessonPlan;
    public LessonMaterial $lessonMaterial;
    public LessonActivity $lessonActivity;
    public function render()
    {
        return view('livewire.lesson-activity.show');
    }
}
