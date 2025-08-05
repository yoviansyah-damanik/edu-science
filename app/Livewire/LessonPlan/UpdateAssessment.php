<?php

namespace App\Livewire\LessonPlan;

use Flux\Flux;
use Livewire\Component;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class UpdateAssessment extends Component
{
    public $enrichment;
    public $remedial;
    public LessonPlan $lessonPlan;

    public function mount()
    {
        $this->enrichment = $this->lessonPlan?->assessment?->enrichment;
        $this->remedial = $this->lessonPlan?->assessment?->remedial;
    }

    public function render()
    {
        return view('livewire.lesson-plan.update-assessment');
    }

    public function update()
    {
        $this->lessonPlan->assessment()->delete();
        $this->lessonPlan->assessment()->create([
            'enrichment' => $this->enrichment,
            'remedial' => $this->remedial,
        ]);

        LivewireAlert::title(__('Successfully'))
            ->text(__(':1 saved successfully', ['1' => __('Assessment')]))
            ->success()
            ->timer(0)
            ->show();

        Flux::modals()->close();
        $this->dispatch('refreshAssessment');
    }
}
