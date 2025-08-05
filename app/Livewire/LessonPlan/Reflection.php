<?php

namespace App\Livewire\LessonPlan;

use Livewire\Component;
use App\Models\LessonPlan;

class Reflection extends Component
{
    public $listeners = ['refreshReflection' => '$refresh'];
    public LessonPlan $lessonPlan;
    public function render()
    {
        return view('livewire.lesson-plan.reflection');
    }
}
