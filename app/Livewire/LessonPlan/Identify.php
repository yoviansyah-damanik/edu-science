<?php

namespace App\Livewire\LessonPlan;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\SchoolProfile;
use Livewire\Attributes\Reactive;

class Identify extends Component
{
    public LessonPlan $lessonPlan;
    public bool $withEditButton;
    public bool $withShowButton;
    public bool $withPrintButton;
    public bool $withLetterhead;
    public string|null $title;

    public function mount(
        $title = null,
        $withEditButton = false,
        $withShowButton = false,
        $withPrintButton = false,
        $withLetterhead = true,
    ) {}
    public function render()
    {
        $school = SchoolProfile::first();

        return view('livewire.lesson-plan.identify', compact('school'));
    }
}
