<?php

namespace App\Livewire\Home;

use App\Models\LessonPlan;
use Livewire\Component;

class User extends Component
{
    public function render()
    {
        $lessonPlans = LessonPlan::owned()
            ->get();

        return view('livewire.home.user', compact('lessonPlans'));
    }
}
