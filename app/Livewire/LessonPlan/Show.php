<?php

namespace App\Livewire\LessonPlan;

use Livewire\Component;
use App\Models\LessonPlan;
use Illuminate\Support\Facades\Cookie;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Show extends Component
{
    public LessonPlan $lessonPlan;

    public function render()
    {
        return view('livewire.lesson-plan.show');
    }
}
