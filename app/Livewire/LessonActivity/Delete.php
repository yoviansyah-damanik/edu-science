<?php

namespace App\Livewire\LessonActivity;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LessonActivity;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public LessonActivity $lessonActivity;

    public bool $isRefresh = false;

    public function render()
    {
        return view('livewire.lesson-activity.delete');
    }

    #[On('setDeleteLessonActivity')]
    public function setDeleteLessonActivity(LessonActivity $lessonActivity, bool $isRefresh = false)
    {
        $this->isRefresh = $isRefresh;
        $this->lessonActivity = $lessonActivity;
        Flux::modal('delete-lesson-activity-modal')
            ->show();
    }

    public function delete()
    {
        try {
            DB::beginTransaction();
            $this->lessonActivity->delete();

            LivewireAlert::title(__('Successfully'))
                ->text(__('Changes saved successfully.'))
                ->success()
                ->show();

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 deleted successfully', ['1' => __('Lesson Activity')])
                ]
            );

            Flux::modals()->close();

            if ($this->isRefresh) {
                $this->redirectRoute('lesson-activities.index', $this->lessonActivity->plan, navigate: true);
            } else {
                $this->dispatch('refreshLessonActivities');
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
