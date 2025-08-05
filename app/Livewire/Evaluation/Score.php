<?php

namespace App\Livewire\Evaluation;

use Livewire\Component;

class Score extends Component
{
    public $scoresPerGroup;
    public $interpretationOfValue;
    public $evaluation;
    public $showOnly;

    public function mount($evaluation, $showOnly = false)
    {
        $excludedGroups = ['REF-1', 'REF-2', 'REF-3', 'REF-4'];

        $groupedResults = $evaluation->answers()
            ->join('evaluation_questions', 'evaluation_answers.evaluation_question_id', '=', 'evaluation_questions.id')
            ->whereNotIn('evaluation_questions.group', $excludedGroups)
            ->selectRaw('evaluation_questions.group as `group`,COUNT(evaluation_answers.id) as total_question,SUM(evaluation_answers.score) as total_score')
            ->groupBy('evaluation_questions.group')
            ->get()
            ->map(function ($item) {
                $item->max_score = $item->total_question * 5;

                $percentage = $item->max_score > 0
                    ? round(($item->total_score / $item->max_score) * 100, 2)
                    : 0;
                $item->percentage = $percentage;

                $item->category = match (true) {
                    $percentage >= 81 => 'Sangat Kompeten',
                    $percentage >= 61 => 'Kompeten',
                    $percentage >= 41 => 'Cukup Kompeten',
                    $percentage >= 21 => 'Kurang Kompeten',
                    default           => 'Sangat Kurang Kompeten',
                };
                return collect($item);
            });

        // Hitung akumulasi
        $summary = collect([
            'group' => 'Total',
            'total_question' => $groupedResults->sum('total_question'),
            'total_score' => $groupedResults->sum('total_score'),
        ])->tap(function ($summary) {
            $summary['max_score'] = $summary['total_question'] * 5;
            $summary['percentage'] = $summary['max_score'] > 0
                ? round(($summary['total_score'] / $summary['max_score']) * 100, 2)
                : 0;

            $summary['category'] = match (true) {
                $summary['percentage'] >= 81 => 'Sangat Kompeten',
                $summary['percentage'] >= 61 => 'Kompeten',
                $summary['percentage'] >= 41 => 'Cukup Kompeten',
                $summary['percentage'] >= 21 => 'Kurang Kompeten',
                default           => 'Sangat Kurang Kompeten',
            };
        });

        $this->scoresPerGroup = $groupedResults->push($summary);
        $this->interpretationOfValue = $this->interpretationOfValue($summary['percentage']);
    }

    private function interpretationOfValue($percentage)
    {
        $score = 1 + ($percentage / 100) * 4;
        return round($score, 2); // dibulatkan 2 digit
    }

    public function render()
    {
        return view('livewire.evaluation.score');
    }
}
