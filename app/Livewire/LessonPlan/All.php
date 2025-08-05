<?php

namespace App\Livewire\LessonPlan;

use App\Models\LessonPlan;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;

    public $semester;
    public $year;
    public $search;
    public int $perPage = 10;

    public function render()
    {
        $items = LessonPlan::with(['user', 'teachingModule'])
            ->where('semester', $this->semester)
            ->where('year', $this->year)
            ->whereLike('title', "%$this->search%")
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.lesson-plan.all', compact('items'));
    }

    public function refresh()
    {
        $this->search = '';
    }
}
