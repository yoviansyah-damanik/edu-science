<?php

namespace App\Livewire\Evaluation;

use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationQuestion;
use Livewire\Component;
use App\Models\LessonPlan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public LessonPlan $lessonPlan;
    public $questions;

    public $answers = [];
    public $ref1;
    public $ref2;
    public $ref3;
    public $ref4;

    public function mount(LessonPlan $lessonPlan)
    {
        if ($lessonPlan->evaluation) {
            return $this->redirectroute('index', $this->lessonPlan, navigate: true);
        }

        $this->questions = EvaluationQuestion::get();
    }

    public function render()
    {
        return view('livewire.evaluation.create');
    }

    public function store()
    {
        $isCompleted = false;

        // Ambil semua ID pertanyaan
        $questionIds = $this->questions->except(['REF-1', 'REF-2', 'REF-3', 'REF-4'])->pluck('id')->all();

        // Ekstrak question ID dari jawaban (misal "1-5" → ambil "1")
        $answeredIds = collect($this->answers)
            ->map(function ($answer) {
                return explode('/', $answer)[0]; // Ambil bagian sebelum tanda '-'
            })
            ->unique()
            ->all();

        // Cek apakah ada pertanyaan yang belum dijawab
        $unansweredIds = array_diff($questionIds, $answeredIds);

        $unansweredCounts = [];

        $questionsByGroup = collect($this->questions)->groupBy('group');
        foreach ($questionsByGroup as $group => $questions) {
            if ($group == 'REF-1') {
                $unansweredCounts[$group] = $this->ref1 ? '1/1' : '0/1';
            } else if ($group == 'REF-2') {
                $unansweredCounts[$group] = $this->ref2 ? '1/1' : '0/1';
            } else if ($group == 'REF-3') {
                $unansweredCounts[$group] = $this->ref3 ? '1/1' : '0/1';
            } else  if ($group == 'REF-4') {
                $unansweredCounts[$group] = $this->ref4 ? '1/1' : '0/1';
            } else {
                $questionIds = collect($questions)->pluck('id')->all();
                $unanswered = array_diff($questionIds, $answeredIds);
                $unansweredCounts[$group] = (count($questionIds) - count($unanswered)) . '/' . count($questionIds);
            }
        }

        // Tentukan apakah semua sudah dijawab
        $isCompleted = count($unansweredIds) - 4 === 0;

        if (!$isCompleted) {
            LivewireAlert::title(__('Attention'))
                ->text(__('Please complete your answers first.') . ' ' . collect($unansweredCounts)->map(function ($count, $group) {
                    return "$group: $count";
                })->implode(', '))
                ->warning()
                ->timer(0)
                ->show();
        } else {
            try {
                DB::beginTransaction();

                $evaluation = $this->lessonPlan->evaluation()->create([
                    'user_id' => auth()->id()
                ]);

                foreach ($this->answers as $answer) {
                    EvaluationAnswer::create([
                        'evaluation_id' => $evaluation->id,
                        'evaluation_question_id' => explode('/', $answer)[0],
                        'answer' => explode('/', $answer)[1],
                        'score' => explode('/', $answer)[1]
                    ]);
                }

                EvaluationAnswer::create([
                    'evaluation_id' => $evaluation->id,
                    'evaluation_question_id' => $this->questions->where('group', 'REF-1')->first()->id,
                    'answer' => $this->ref1,
                    'score' => 1
                ]);
                EvaluationAnswer::create([
                    'evaluation_id' => $evaluation->id,
                    'evaluation_question_id' => $this->questions->where('group', 'REF-2')->first()->id,
                    'answer' => $this->ref1,
                    'score' => 1
                ]);
                EvaluationAnswer::create([
                    'evaluation_id' => $evaluation->id,
                    'evaluation_question_id' => $this->questions->where('group', 'REF-3')->first()->id,
                    'answer' => $this->ref2,
                    'score' => 1
                ]);
                EvaluationAnswer::create([
                    'evaluation_id' => $evaluation->id,
                    'evaluation_question_id' => $this->questions->where('group', 'REF-4')->first()->id,
                    'answer' => $this->ref3,
                    'score' => 1
                ]);

                session()->flash(
                    'saved',
                    [
                        'title' => __('Successfully'),
                        'text' => __(':1 saved successfully', ['1' => __('Evaluation')])
                    ]
                );

                DB::commit();
                $this->redirectroute('index', $this->lessonPlan, navigate: true);
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
}
