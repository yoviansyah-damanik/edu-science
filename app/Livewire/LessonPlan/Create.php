<?php

namespace App\Livewire\LessonPlan;

use App\Models\FacilitiesInfrastructure;
use App\Models\LessonPlan;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public string $semester;
    public int $year;

    public $title;
    public $phases;
    public $phase;
    public $timeAllocation;
    public $subject = 'IPA';
    public $subjectElement = "Kontribusi Sains";
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

    public function mount(string $semester, int $year)
    {
        $exist = LessonPlan::where('semester', $semester)
            ->where('year', $year)
            ->where('user_id', auth()->id())
            ->first();
        if ($exist) {
            session()->flash(
                'saved',
                [
                    'title' => __('Congratulation'),
                    'text' => __('You have added the lesson plan, please continue to make changes.')
                ]
            );
            $this->redirectroute('index', $exist->id, navigate: true);
        }
        $this->classes = ['VII', 'VIII', 'IX'];
        $this->class = $this->classes[0];
        $this->phases = ['A', 'B', 'C', 'D'];
        $this->phase = $this->phases[0];

        $this->facilitiesList = FacilitiesInfrastructure::get();
    }

    public function render()
    {
        return view('livewire.lesson-plan.create');
    }

    public function rules(): array
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
            'initialCompetencies.*' => 'required|string|max:220',
            'facilities' => 'required|array',
            'facilities.*' => [
                Rule::in($this->facilitiesList->pluck('id'))
            ],
            'profileOfPancasilas' => 'required|array',
            'profileOfPancasilas.*' => 'required|string|max:220',
            'targets' => 'required|array',
            'targets.*' => 'required|string|max:220',
            'objectives' => 'required|array',
            'objectives.*' => 'required|string|max:220',
            'understandings' => 'required|array',
            'understandings.*' => 'required|string|max:220',
            'triggerQuestions' => 'required|array',
            'triggerQuestions.*' => 'required|string|max:220',
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

            $lessonPlan = LessonPlan::create([
                'title' => $this->title,
                'phase' => $this->phase,
                'time_allocation' => $this->timeAllocation,
                'subject' => $this->subject,
                'subject_element' => $this->subjectElement,
                'class' => $this->class,
                'semester' => $this->semester,
                'year' => $this->year,
                'user_id' => auth()->id(),
            ]);

            $teachingModule = $lessonPlan->teachingModule()->create([
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
            $this->redirectroute('show', $lessonPlan->id, navigate: true);
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
