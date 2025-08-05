<?php

namespace App\Livewire\LessonActivity;

use App\Models\LessonActivity;
use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\LessonMaterial;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Index extends Component
{
    public $listeners = ['refreshLessonActivities' => '$refresh'];

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
            ->lessonActivities()
            ->with(['material', 'material.user'])
            ->paginate();

        return view('livewire.lesson-activity.index', compact('items'));
    }
}
