<?php

namespace App\Livewire\LessonAssessment;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\LessonMaterial;
use App\Models\LessonAssessment;

class Show extends Component
{
    public LessonPlan $lessonPlan;
    public LessonMaterial $lessonMaterial;
    public LessonAssessment $lessonAssessment;

    public function render()
    {
        return view('livewire.lesson-assessment.show');
    }
}
