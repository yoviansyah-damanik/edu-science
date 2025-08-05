<?php

namespace App\Livewire\LessonPlan;

use Flux\Flux;
use Livewire\Component;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class UpdateReflection extends Component
{
    public LessonPlan $lessonPlan;
    public $student;
    public $teacher;

    public function mount()
    {
        $this->student = $this->lessonPlan->student;
        $this->teacher = $this->lessonPlan->teacher;
    }
    public function render()
    {
        return view('livewire.lesson-plan.update-reflection');
    }

    public function update()
    {
        $this->lessonPlan->reflection()->delete();
        $this->lessonPlan->reflection()->create([
            'student' => $this->student,
            'teacher' => $this->teacher,
        ]);

        LivewireAlert::title(__('Successfully'))
            ->text(__(':1 saved successfully', ['1' => __('Reflection')]))
            ->success()
            ->timer(0)
            ->show();

        Flux::modals()->close();
        $this->dispatch('refreshReflection');
    }
}
