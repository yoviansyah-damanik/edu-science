<?php

namespace App\Livewire\LessonPlan;

use Livewire\Component;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Index extends Component
{
    public LessonPlan $lessonPlan;

    public function mount(LessonPlan $lessonPlan)
    {
        if (session()->has('saved')) {
            LivewireAlert::title(session('saved.title'))
                ->text(session('saved.text'))
                ->success()
                ->show();
        }

        $lessonPlan = $lessonPlan->load([
            'materials',
            'materials.worksheet',
            'materials.activity',
            'teachingModule',
        ]);
    }

    public function render()
    {
        return view('livewire.lesson-plan.index');
    }
}
