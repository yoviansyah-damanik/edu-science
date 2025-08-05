<?php

namespace App\Livewire\LessonMaterialCategory;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LessonMaterialCategory;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public LessonMaterialCategory $category;

    public function render()
    {
        return view('livewire.lesson-material-category.delete');
    }

    #[On('setDeleteCategory')]
    public function setDeleteFacility(LessonMaterialCategory $category)
    {
        $this->category = $category;
        Flux::modal('delete-category-modal')
            ->show();
    }

    public function delete()
    {
        try {
            $this->category->delete();
            $this->dispatch('refreshCategories');
            Flux::modals()->close();
            LivewireAlert::title(__('Successfully'))
                ->text(__(':1 deleted successfully', ['1' => __('Lesson Material Category')]))
                ->success()
                ->timer(0)
                ->show();
        } catch (\Exception $e) {
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
