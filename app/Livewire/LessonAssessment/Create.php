<?php

namespace App\Livewire\LessonAssessment;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public $assessment;
    public LessonPlan $lessonPlan;
    public LessonMaterial $lessonMaterial;

    public function render()
    {
        return view('livewire.lesson-assessment.create');
    }

    public function rules()
    {
        return [
            'assessment' => 'required|string'
        ];
    }

    public function validationAttributes()
    {
        return [
            'assessment' => __('Assessment')
        ];
    }
    public function store()
    {
        $this->validate();
        try {
            $this->lessonMaterial->assessment()->create([
                'assessment' => $this->assessment,
            ]);
            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 saved successfully', ['1' => __('Assessment')])
                ]
            );
            DB::commit();
            $this->redirectRoute('lesson-assessments.index', ['lessonPlan' => $this->lessonPlan], navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
