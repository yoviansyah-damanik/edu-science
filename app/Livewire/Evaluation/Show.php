<?php

namespace App\Livewire\Evaluation;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\LessonPlan;
use App\Models\EvaluationQuestion;

class Show extends Component
{
    public LessonPlan $lessonPlan;
    public $questions;
    public $grouped;

    public function mount(LessonPlan $lessonPlan)
    {
        $evaluation = $lessonPlan->evaluation;
        $this->questions = EvaluationQuestion::get();

        // Ambil semua jawaban dan pertanyaan terkait
        $answers = $evaluation->answers()
            ->with('question') // eager load pertanyaan
            ->get();

        // Kelompokkan berdasarkan group dari pertanyaan
        $this->grouped = $answers->groupBy(fn($answer) => $answer->question->group)
            ->map(function ($answersInGroup, $groupName) {
                return [
                    'group' => $groupName,
                    'answers' => $answersInGroup->map(function ($answer) {
                        return [
                            'question_id' => $answer->evaluation_question_id,
                            'answer' => $answer->answer,
                        ];
                    })->values(),
                ];
            })
            ->values(); // buang key agar hasilnya indexed array
        // dd($this->grouped);
    }

    public function render()
    {
        return view('livewire.evaluation.show');
    }
}
