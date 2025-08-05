<?php

namespace App\Livewire\LessonActivity;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\LessonActivity;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{
    public $introduction;
    public $core;
    public $closing;
    public $introductionTime;
    public $coreTime;
    public $closingTime;
    public LessonPlan $lessonPlan;
    public LessonMaterial $lessonMaterial;
    public LessonActivity $lessonActivity;

    public function mount()
    {
        $this->introduction = $this->lessonActivity->introduction;
        $this->core = $this->lessonActivity->core;
        $this->closing = $this->lessonActivity->closing;
        $this->introductionTime = $this->lessonActivity->introduction_time;
        $this->coreTime = $this->lessonActivity->core_time;
        $this->closingTime = $this->lessonActivity->closing_time;
    }

    public function render()
    {
        return view('livewire.lesson-activity.edit');
    }

    public function rules()
    {
        return [
            'introduction' => 'required|string',
            'core' => 'required|string',
            'closing' => 'required|string',
            'introductionTime' => 'required|numeric',
            'coreTime' => 'required|numeric',
            'closingTime' => 'required|numeric',
        ];
    }
    public function validationRules()
    {
        return [
            'introduction' => __('Introduction'),
            'core' => __('Core'),
            'closing' => __('Closing'),
            'introductionTime' => __('Introduction Time'),
            'coreTime' => __('Core Time'),
            'closingTime' => __('Closing Time'),
        ];
    }

    public function update()
    {
        $this->validate();
        try {
            $this->lessonActivity->delete();
            $this->lessonMaterial->activity()->create([
                'introduction' => $this->introduction,
                'core' => $this->core,
                'closing' => $this->closing,
                'introduction_time' => $this->introductionTime,
                'core_time' => $this->coreTime,
                'closing_time' => $this->closingTime,
            ]);
            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 saved successfully', ['1' => __('Lesson Activity')])
                ]
            );
            DB::commit();
            $this->redirectRoute('lesson-activities.index', ['lessonPlan' => $this->lessonPlan, 'lessonMaterial' => $this->lessonMaterial], navigate: true);
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
