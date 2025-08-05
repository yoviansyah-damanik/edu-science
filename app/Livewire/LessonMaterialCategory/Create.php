<?php

namespace App\Livewire\LessonMaterialCategory;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LessonMaterialCategory;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public $name;
    public $description;
    public function render()
    {
        return view('livewire.lesson-material-category.create');
    }

    #[On('setCreateCategory')]
    public function setCreateCategory()
    {
        Flux::modal('create-category-modal')
            ->show();
    }

    public function store()
    {
        try {
            LessonMaterialCategory::create([
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
