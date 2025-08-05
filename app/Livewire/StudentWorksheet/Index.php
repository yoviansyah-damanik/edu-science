<?php

namespace App\Livewire\StudentWorksheet;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\StudentWorksheet;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Index extends Component
{
    public $listeners = ['refreshStudentWorksheets' => '$refresh'];

    public int $perPage = 10;
    public LessonPlan $lessonPlan;

    public function mount(LessonPlan $lessonPlan)
    {
        if ($lessonPlan->user_id != auth()->id()) {
            return $this->redirectroute('index', $lessonPlan);
        }

        if (session()->has('saved')) {
            if (session('saved.type') == 'warning')
                LivewireAlert::title(session('saved.title'))
                    ->text(session('saved.text'))
                    ->warning()
                    ->show();
            else
                LivewireAlert::title(session('saved.title'))
                    ->text(session('saved.text'))
                    ->success()
                    ->show();
        }
    }

    public function render()
    {
        $items = $this->lessonPlan->studentWorksheets()
            ->with(['user', 'material'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.student-worksheet.index', compact('items'));
    }
}
