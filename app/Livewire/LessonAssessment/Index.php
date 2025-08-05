<?php

namespace App\Livewire\LessonAssessment;

use Livewire\Component;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Index extends Component
{
    public $listeners = ['refreshLessonAssessments' => '$refresh'];

    public string $search = '';
    public int $perPage = 10;
    public LessonPlan $lessonPlan;
    public function mount()
    {
        if ($this->lessonPlan->user_id != auth()->id()) {
            return $this->redirectroute('index', $this->lessonPlan);
        }
        if (session()->has('saved')) {
            LivewireAlert::title(session('saved.title'))
                ->text(session('saved.text'))
                ->success()
                ->show();
        }
    }

    public function render()
    {
        $items = $this->lessonPlan
            ->lessonAssessments()
            ->with(['material', 'material.user'])
            ->paginate();

        return view('livewire.lesson-assessment.index', compact('items'));
    }
}
