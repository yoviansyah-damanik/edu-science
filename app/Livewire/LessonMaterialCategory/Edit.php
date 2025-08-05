<?php

namespace App\Livewire\LessonMaterialCategory;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LessonMaterialCategory;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{
    public $name;
    public $description;
    public LessonMaterialCategory $category;
    public function render()
    {
        return view('livewire.lesson-material-category.edit');
    }

    #[On('setEditCategory')]
    public function setEditCategory(LessonMaterialCategory $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        Flux::modal('edit-category-modal')
            ->show();
    }

    public function update()
    {
        try {
            $this->category->update([
                'name' => $this->name,
                'description' => $this->description
            ]);

            $this->reset();
            $this->dispatch('refreshCategories');
            Flux::modals()->close();
            LivewireAlert::title(__('Successfully'))
                ->text(__(':1 saved successfully', ['1' => __('Lesson Material Category')]))
                ->success()
                ->timer(0)
                ->show();
        } catch (\Exception $e) {
            Flux::modals()->close();
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
