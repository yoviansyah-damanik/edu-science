<?php

namespace App\Livewire\StudentWorksheet;

use Livewire\Component;
use App\Models\LessonPlan;
use App\Models\LessonMaterial;
use Illuminate\Validation\Rule;
use App\Models\StudentWorksheet;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public $basicCompetency = 'tes basicCompetency';
    public $objective = 'tes objective';
    public $basicSkill = 'tes basicSkill';
    public $abilityBasic = 'tes abilityBasic';
    public $abilityIntermediate = 'tes abilityIntermediate';
    public $abilityAdvanced = 'tes abilityAdvanced';
    public $styleVisual = 'tes styleVisual';
    public $styleAudio = 'tes styleAudio';
    public $styleKinesthetic = 'tes styleKinesthetic';
    public $interestTechnique = 'tes interestTechnique';
    public $interestAdventure = 'tes interestAdventure';
    public $interestHousehold = 'tes interestHousehold';
    public $questionLv1 = 'tes questionLv1';
    public $questionLv2 = 'tes questionLv2';
    public $questionLv3 = 'tes questionLv3';
    public $evaluationBasic = 'tes evaluationBasic';
    public $evaluationIntermediate = 'tes evaluationIntermediate';
    public $evaluationAdvanced = 'tes evaluationAdvanced';
    public $project = 'tes project';
    public $reflectionBasic = 'tes reflectionBasic';
    public $reflectionIntermediate = 'tes reflectionIntermediate';
    public $reflectionAdvanced = 'tes reflectionAdvanced';
    public $answerKey = 'tes answerKey';
    public $assessmentSection = 'tes assessmentSection';
    public LessonPlan $lessonPlan;
    public LessonMaterial $lessonMaterial;

    public function render()
    {
        return view('livewire.student-worksheet.create');
    }

    public function rules()
    {
        return [
            'basicCompetency' => 'required|string',
            'objective' => 'required|string',
            'basicSkill' => 'required|string',
            'abilityBasic' => 'required|string',
            'abilityIntermediate' => 'required|string',
            'abilityAdvanced' => 'required|string',
            'styleVisual' => 'required|string',
            'styleAudio' => 'required|string',
            'styleKinesthetic' => 'required|string',
            'interestTechnique' => 'required|string',
            'interestAdventure' => 'required|string',
            'interestHousehold' => 'required|string',
            'questionLv1' => 'required|string',
            'questionLv2' => 'required|string',
            'questionLv3' => 'required|string',
            'evaluationBasic' => 'required|string',
            'evaluationIntermediate' => 'required|string',
            'evaluationAdvanced' => 'required|string',
            'project' => 'required|string',
            'reflectionBasic' => 'required|string',
            'reflectionIntermediate' => 'required|string',
            'reflectionAdvanced' => 'required|string',
            'answerKey' => 'required|string',
            'assessmentSection' => 'required|string',
        ];
    }
    public function validationAttributes()
    {
        return [
            'basicCompetency' => __('Basic Competency'),
            'objective' => __('Lesson Objective'),
            'basicSkill' => __('Basic Skill'),
            'abilityBasic' => __('For students who need more help'),
            'abilityIntermediate' => __('For students with average abilities'),
            'abilityAdvanced' => __('For students with high abilities'),
            'styleVisual' => __('For Visual Learners'),
            'styleAudio' => __('For Audio Learners'),
            'styleKinesthetic' => __('For Kinesthetic Learners'),
            'interestTechnique' => __('For Students Who Like Engineering/Construction'),
            'interestAdventure' => __('For Students Who Like Adventure'),
            'interestHousehold' => __('For Students Who Like Home Economics'),
            'questionLv1' => __('Level :1 Challenge', ['1' => 1]),
            'questionLv2' => __('Level :1 Challenge', ['1' => 2]),
            'questionLv3' => __('Level :1 Challenge', ['1' => 3]),
            'evaluationBasic' => __(':1 Evaluation', ['1' => __('Basic')]),
            'evaluationIntermediate' => __(':1 Evaluation', ['1' => __('Intermediate')]),
            'evaluationAdvanced' => __(':1 Evaluation', ['1' => __('Advanced')]),
            'project' => __('Application Project'),
            'reflectionBasic' => __(':1 Reflection', ['1' => __('Basic')]),
            'reflectionIntermediate' => __(':1 Reflection', ['1' => __('Intermediate')]),
            'reflectionAdvanced' => __(':1 Reflection', ['1' => __('Advanced')]),
            'answerKey' => __('Answer Key'),
            'assessmentSection' => __('Assesment Section'),
        ];
    }

    public function store()
    {
        $this->validate();
        try {
            $this->lessonMaterial->worksheet()->create([
                'basic_competency' => $this->basicCompetency,
                'objective' => $this->objective,
                'basic_skill' => $this->basicSkill,
                'ability_basic' => $this->abilityBasic,
                'ability_intermediate' => $this->abilityIntermediate,
                'ability_advanced' => $this->abilityAdvanced,
                'style_visual' => $this->styleVisual,
                'style_audio' => $this->styleAudio,
                'style_kinesthetic' => $this->styleKinesthetic,
                'interest_technique' => $this->interestTechnique,
                'interest_adventure' => $this->interestAdventure,
                'interest_household' => $this->interestHousehold,
                'question_lv_1' => $this->questionLv1,
                'question_lv_2' => $this->questionLv2,
                'question_lv_3' => $this->questionLv3,
                'evaluation_basic' => $this->evaluationBasic,
                'evaluation_intermediate' => $this->evaluationIntermediate,
                'evaluation_advanced' => $this->evaluationAdvanced,
                'project' => $this->project,
                'reflection_basic' => $this->reflectionBasic,
                'reflection_intermediate' => $this->reflectionIntermediate,
                'reflection_advanced' => $this->reflectionAdvanced,
                'answer_key' => $this->answerKey,
                'assessment_section' => $this->assessmentSection,
                'user_id' => auth()->id(),
            ]);

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 saved successfully', ['1' => __('Student Worksheet')])
                ]
            );
            $this->redirectRoute('student-worksheet.index', $this->lessonPlan, navigate: true);
        } catch (\Exception $e) {
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
