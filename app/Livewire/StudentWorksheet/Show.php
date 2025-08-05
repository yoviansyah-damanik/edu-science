<?php

namespace App\Livewire\StudentWorksheet;

use App\Models\LessonPlan;
use App\Models\StudentWorksheet;
use Livewire\Component;

class Show extends Component
{
    public LessonPlan $lessonPlan;
    public StudentWorksheet $studentWorksheet;

    public function render()
    {
        return view('livewire.student-worksheet.show');
    }
}
