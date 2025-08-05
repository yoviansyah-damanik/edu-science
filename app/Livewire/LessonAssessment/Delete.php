<?php

namespace App\Livewire\LessonAssessment;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LessonAssessment;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public LessonAssessment $lessonAssessment;
    public bool $isRefresh = false;

    public function render()
    {
        return view('livewire.lesson-assessment.delete');
    }

    #[On('setDeleteLessonAssessment')]
    public function setDeleteLessonAssessment(LessonAssessment $lessonAssessment, bool $isRefresh = false)
    {
        $this->isRefresh = $isRefresh;
        $this->lessonAssessment = $lessonAssessment;
        Flux::modal('delete-lesson-assessment-modal')
            ->show();
    }

    public function delete()
    {
        try {
            DB::beginTransaction();
            $this->lessonAssessment->delete();

            LivewireAlert::title(__('Successfully'))
                ->text(__('Changes saved successfully.'))
                ->success()
                ->show();

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 deleted successfully', ['1' => __('Assessment')])
                ]
            );

            Flux::modals()->close();

            if ($this->isRefresh) {
                $this->redirectRoute('lesson-assessments.index', $this->lessonAssessment->plan, navigate: true);
            } else {
                $this->dispatch('refreshLessonAssessments');
                $this->dispatch('refreshLessonMaterials');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
