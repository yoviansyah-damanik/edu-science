<?php

namespace App\View\Components\StudentWorksheet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $lessonPlan,
        public $studentWorksheet,
        public bool $showOnly = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-worksheet.show');
    }
}
