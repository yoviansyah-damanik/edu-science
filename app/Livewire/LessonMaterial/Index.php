<?php

namespace App\Livewire\LessonMaterial;

use App\Models\LessonMaterial;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\LessonPlan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\LessonMaterialCategory;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Index extends Component
{
    use WithPagination;

    public $listeners = ['refreshLessonMaterials' => '$refresh'];

    public string $search = '';
    public int $perPage = 10;
    public $lessonMaterialCategories;
    public $lessonMaterialCategory = 'all';
    public LessonPlan $lessonPlan;

    public function mount()
    {
        if ($this->lessonPlan->user_id != auth()->id()) {
            return $this->redirectroute('index', $this->lessonPlan);
        }
        if (session()->has('saved')) {
            LivewireAlert::title(session('saved.title'))
                ->text(session('saved.text'))
                ->success()
                ->show();
        }

        $this->lessonMaterialCategories = LessonMaterialCategory::active()
            ->get();
    }

    public function render(): View
    {
        $items = auth()->user()->lessonMaterials()
            ->with(['category', 'user', 'files', 'worksheet', 'assessment', 'activity'])
            ->when($this->lessonMaterialCategory !== 'all', function ($query) {
                $query->where('lesson_material_category_id', $this->lessonMaterialCategory);
            })
            ->where('lesson_plan_id', $this->lessonPlan->id)
            ->whereLike('title',  '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.lesson-material.index', compact('items'));
    }

    public function setOrder($id, $order)
    {
        try {
            DB::beginTransaction();

            $first = LessonMaterial::find($id);

            $second = LessonMaterial::where('order', $order)
                ->first();
            if ($second) {
                $second->order = $first->order;
                $second->save();
            }

            $first->order = $order;
            $first->save();

            LivewireAlert::title(__('Successfully'))
                ->text(__(':1 saved successfully', ['1' => __('Lesson Material')]))
                ->success()
                ->timer(0)
                ->show();
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

    public function refresh()
    {
        $this->lessonMaterialCategory = 'all';
        $this->search = '';
        $this->resetPage();
    }
}
