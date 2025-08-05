<?php

namespace App\Livewire\LessonPlan;

use Livewire\Component;
use App\Models\LessonPlan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\FacilitiesInfrastructure;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{

    public $semester;
    public $year;
    public $title;
    public $phases;
    public $phase;
    public $timeAllocation;
    public $subject;
    public $subjectElement;
    public $classes;
    public $class;
    public $lessonModel;
    public $initialCompetencies = [];
    public $profileOfPancasilas = [];
    public $targets = [];
    public $objectives = [];
    public $understandings = [];
    public $triggerQuestions = [];

    public $facilitiesList;
    public $facilities = [];

    public LessonPlan $lessonPlan;

    public function mount(LessonPlan $lessonPlan)
    {
        $this->classes = ['VII', 'VIII', 'IX'];
        $this->phases = ['A', 'B', 'C', 'D'];

        $this->facilitiesList = FacilitiesInfrastructure::get();

        $this->class = $this->classes[0];
        $this->phase = $this->phases[0];

        $this->semester = $lessonPlan->semester;
        $this->year = $lessonPlan->year;

        $this->title = $lessonPlan->title;
        $this->phase = $lessonPlan->phase;
        $this->timeAllocation = $lessonPlan->time_allocation;
        $this->subject = $lessonPlan->subject;
        $this->subjectElement = $lessonPlan->subject_element;
        $this->class = $lessonPlan->class;
        $this->lessonModel = $lessonPlan->lesson_model;

        $this->initialCompetencies = $lessonPlan->initialCompetencies->pluck('text');
        $this->profileOfPancasilas = $lessonPlan->profileOfPancasilas->pluck('text');
        $this->targets = $lessonPlan->targets->pluck('text');
        $this->objectives = $lessonPlan->objectives->pluck('text');
        $this->understandings = $lessonPlan->understandings->pluck('text');
        $this->triggerQuestions = $lessonPlan->triggerQuestions->pluck('text');

        $this->facilities = $lessonPlan->hasFacilitiesInfrastructures()->pluck('facilities_infrastructure_id');
    }

    public function render()
    {
        return view('livewire.lesson-plan.edit');
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:200',
            'phase' => [
                'required',
                'string',
                Rule::in($this->phases)
            ],
            'timeAllocation' => 'required|string',
            'subject' => 'required|string',
            'subjectElement' => 'required|string',
            'class' => [
                'required',
                'string',
                Rule::in($this->classes)
            ],
            'lessonModel' => 'required|string',
            'initialCompetencies' => 'required|array',
            'initialCompetencies.*' => 'string|max:220',
            'facilities' => 'required|array',
            'facilities.*' => [
                Rule::in($this->facilitiesList->pluck('id'))
            ],
            'profileOfPancasilas' => 'required|array',
            'profileOfPancasilas.*' => 'string|max:220',
            'targets' => 'required|array',
            'targets.*' => 'string|max:220',
            'objectives' => 'required|array',
            'objectives.*' => 'string|max:220',
            'understandings' => 'required|array',
            'understandings.*' => 'string|max:220',
            'triggerQuestions' => 'required|array',
            'triggerQuestions.*' => 'string|max:220',
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => __('Title'),
            'phase' => __('Phase'),
            'timeAllocation' => __('Time Allocation'),
            'subject' => __('Subject'),
            'subjectElement' => __('Subject Element'),
            'class' => __('Class'),
            'lessonModel' => __('Lesson Model'),
            'initialCompetencies' => __('Initial Competencies'),
            'initialCompetencies.*' => __('Initial Competency'),
            'profileOfPancasilas' => __('Profile of Pancasila Students'),
            'profileOfPancasilas.*' => __('Profile of Pancasila Student'),
            'targets' => __('Target Students'),
            'targets.*' => __('Target Students'),
            'objectives' => __('Lesson Objectives'),
            'objectives.*' => __('Lesson Objective'),
            'understandings' => __('Meaningful Understandings'),
            'understandings.*' => __('Meaningful Understanding'),
            'triggerQuestions' => __('Trigger Questions'),
            'triggerQuestions.*' => __('Trigger Question'),
            'facilities' => __('Facilities') . '/' . __('Infrastructures'),
        ];
    }

    public function store()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $this->lessonPlan->update([
                'title' => $this->title,
                'phase' => $this->phase,
                'time_allocation' => $this->timeAllocation,
                'subject' => $this->subject,
                'subject_element' => $this->subjectElement,
                'class' => $this->class,
                'semester' => $this->semester,
                'year' => $this->year,
                'lesson_model' => $this->lessonModel,
            ]);

            $this->teachingModule()->delete();

            $this->lessonPlan->initialCompetencies()->delete();
            $this->lessonPlan->profileOfPancasilas()->delete();
            $this->lessonPlan->targets()->delete();
            $this->lessonPlan->objectives()->delete();
            $this->lessonPlan->understandings()->delete();
            $this->lessonPlan->triggerQuestions()->delete();
            $this->lessonPlan->hasFacilitiesInfrastructures()->delete();

            $teachingModule = $this->lessonPlan->teachingModule()->create([
                'lesson_model' => $this->lessonModel,
            ]);

            foreach ($this->initialCompetencies as $initialCompetency) {
                $teachingModule->initialCompetencies()->create([
                    'text' => $initialCompetency
                ]);
            }
            foreach ($this->profileOfPancasilas as $profileOfPancasila) {
                $teachingModule->profileOfPancasilas()->create([
                    'text' => $profileOfPancasila
                ]);
            }
            foreach ($this->targets as $target) {
                $teachingModule->targets()->create([
                    'text' => $target
                ]);
            }
            foreach ($this->objectives as $objective) {
                $teachingModule->objectives()->create([
                    'text' => $objective
                ]);
            }
            foreach ($this->understandings as $understanding) {
                $teachingModule->understandings()->create([
                    'text' => $understanding
                ]);
            }
            foreach ($this->triggerQuestions as $triggerQuestion) {
                $teachingModule->triggerQuestions()->create([
                    'text' => $triggerQuestion
                ]);
            }

            foreach ($this->facilities as $facility) {
                $teachingModule->hasFacilitiesInfrastructures()->create([
                    'facilities_infrastructure_id' => $facility
                ]);
            }

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 saved successfully', ['1' => __('Lesson Plan')])
                ]
            );
            DB::commit();
            $this->redirectroute('show', $this->lessonPlan->id, navigate: true);
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
