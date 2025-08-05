<?php

namespace App\Livewire\LessonMaterial;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\DB;
use App\Models\LessonMaterialCategory;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    use WithFileUploads;
    public string $title;
    public string $summary;
    public string $content;
    public ?string $youtubeUrl = null;
    public $attachments = [];
    public $lessonMaterialCategories;
    public ?int $lessonMaterialCategory;
    public LessonPlan $lessonPlan;

    public function mount(LessonPlan $lessonPlan)
    {
        $this->lessonMaterialCategories = LessonMaterialCategory::active()
            ->get();
        $this->lessonMaterialCategory = $this->lessonMaterialCategories->first()?->id ?? null;
    }

    public function render()
    {
        return view('livewire.lesson-material.create');
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'youtubeUrl' => [
                'nullable',
                'url',
                'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.be)\/.+$/'
            ],
            'lessonMaterialCategory' => 'required|exists:lesson_material_categories,id',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png,webp,bmp,gif,svg|max:5120', // Maksimal 5Mb per file
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => __('Title'),
            'summary' => __('Summary'),
            'content' => __('Content'),
            'lessonMaterialCategory' => __('Lesson Material Category'),
            'attachments' => __('Attachments'),
            'youtubeUrl' => __('Youtube'),
        ];
    }

    public function store()
    {
        $this->validate();
        try {
            DB::beginTransaction();

            $newOrder = $this->lessonPlan->materials()->count() + 1;

            $newLessonMaterial = $this->lessonPlan->materials()->create([
                'title' => trim($this->title),
                'summary' => $this->summary,
                'content' => $this->content,
                'youtube_url' => $this->youtubeUrl,
                'lesson_material_category_id' => $this->lessonMaterialCategory,
                'order' => $newOrder,
                'user_id' => auth()->id()
            ]);

            foreach ($this->attachments as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/lesson-materials', $filename, 'public');

                $newLessonMaterial->files()->create([
                    'filename' => $file->getClientOriginalName(),
                    'filetype' => $file->getClientOriginalExtension(),
                    'url' => 'storage/' . $path,
                    'user_id' => auth()->id(),
                ]);
            }

            session()->flash(
                'saved',
                [
                    'title' => __('Successfully'),
                    'text' => __(':1 saved successfully', ['1' => __('Lesson Material')])
                ]
            );
            DB::commit();
            $this->redirectRoute('lesson-materials.index', $this->lessonPlan, navigate: true);
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
