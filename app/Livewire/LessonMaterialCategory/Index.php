<?php

namespace App\Livewire\LessonMaterialCategory;

use App\Models\LessonMaterialCategory;
use Livewire\Component;

class Index extends Component
{
    public $listeners = ['refreshCategories' => '$refresh'];

    public string $search = '';
    public int $perPage = 10;
    public function render()
    {
        $items = LessonMaterialCategory::whereLike('name', "%$this->search%")
            ->paginate($this->perPage);

        return view('livewire.lesson-material-category.index', compact('items'));
    }

    public function refresh()
    {
        $this->search = '';
        $this->resetPage();
    }
}
