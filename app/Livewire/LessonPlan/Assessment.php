<?php

namespace App\Livewire\LessonPlan;

use App\Models\LessonPlan;
use Livewire\Component;

class Assessment extends Component
{
    public $listeners = ['refreshAssessment' => '$refresh'];
    public LessonPlan $lessonPlan;
    public function render()
    {
        return view('livewire.lesson-plan.assessment');
    }
}
