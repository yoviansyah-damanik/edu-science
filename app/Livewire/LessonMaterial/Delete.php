<?php

namespace App\Livewire\LessonMaterial;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\MagicHelper;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public LessonMaterial $lessonMaterial;
    public bool $isRefresh = false;

    public function render()
    {
        return view('livewire.lesson-material.delete');
    }

    #[On('setDeleteLessonMaterial')]
    public function setDeleteLessonMaterial(LessonMaterial $lessonMaterial, bool $isRefresh = false)
    {
        $this->isRefresh = $isRefresh;
        $this->lessonMaterial = $lessonMaterial;
        Flux::modal('delete-lesson-material-modal')
            ->show();
    }

    public function delete()
    {
        try {
            DB::beginTransaction();
            foreach ($this->lessonMaterial->files as $file) {
                $deleteFile = MagicHelper::delete($file->url);
                if ($deleteFile === true) {
                    $file->delete();
                } else {
                    LivewireAlert::title(__('Attention'))
                        ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $deleteFile . ' (' . __('Filename') . ': ' . $file->filename . ')')
                        ->error()
                        ->show();
                }
            }

            $this->lessonMaterial->delete();

            LivewireAlert::title(__('Successfully'))
                ->text(__('Changes saved successfully.'))
                ->success()
                ->show();

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 deleted successfully', ['1' => __('Lesson Material')])
                ]
            );

            Flux::modals()->close();

            if ($this->isRefresh) {
                $this->redirectRoute('lesson-materials.index', $this->lessonMaterial->plan, navigate: true);
            } else {
                $this->dispatch('refreshLessonMaterials');
            }
            DB::commit();
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
