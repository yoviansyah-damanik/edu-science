<?php

namespace App\Livewire\StudentWorksheet;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentWorksheet;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public StudentWorksheet $studentWorksheet;
    public bool $isRefresh = false;

    public function render()
    {
        return view('livewire.student-worksheet.delete');
    }

    #[On('setDeleteStudentWorksheet')]
    public function setDeleteStudentWorksheet(StudentWorksheet $studentWorksheet, bool $isRefresh = false)
    {
        $this->isRefresh = $isRefresh;
        $this->studentWorksheet = $studentWorksheet;
        Flux::modal('delete-student-worksheet-modal')
            ->show();
    }

    public function delete()
    {
        try {
            $this->studentWorksheet->delete();

            LivewireAlert::title(__('Successfully'))
                ->text(__('Changes saved successfully.'))
                ->success()
                ->show();

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 deleted successfully', ['1' => __('Student Worksheet')])
                ]
            );

            Flux::modals()->close();

            if ($this->isRefresh) {
                $this->redirectRoute('student-worksheet.index', $this->studentWorksheet->plan, navigate: true);
            } else {
                $this->dispatch('refreshStudentWorksheets');
                $this->dispatch('refreshLessonMaterials');
            }
        } catch (\Exception $e) {
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
