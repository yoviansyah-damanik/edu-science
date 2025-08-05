<?php

namespace App\View\Components\LessonActivity;

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
        public $lessonActivity,
        public bool $showOnly = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lesson-activity.show');
    }
}
