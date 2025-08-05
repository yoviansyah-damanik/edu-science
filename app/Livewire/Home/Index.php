<?php

namespace App\Livewire\Home;

use App\Models\LessonPlan;
use App\Models\SchoolProfile;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $school = SchoolProfile::first();

        return view('livewire.home.index', compact('school'));
    }
}
