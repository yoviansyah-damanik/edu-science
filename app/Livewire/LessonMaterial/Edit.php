<?php

namespace App\Livewire\LessonMaterial;

use Flux\Flux;
use App\Models\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\DB;
use App\Models\LessonMaterialCategory;
use App\Models\LessonPlan;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{
    use WithFileUploads;
    public string $title;
    public string $summary;
    public string $content;
    public ?string $youtubeUrl = null;
    public $attachments = [];
    public $lessonMaterialCategories;
    public ?int $lessonMaterialCategory;
    public LessonMaterial $lessonMaterial;
    public $lessonPlan;

    public function mount(LessonMaterial $lessonMaterial, LessonPlan $lessonPlan)
    {
        $this->title = $lessonMaterial->title;
        $this->summary = $lessonMaterial->summary;
        $this->content = $lessonMaterial->content;
        $this->youtubeUrl = $lessonMaterial->youtube_url;

        $this->lessonMaterialCategories = LessonMaterialCategory::active()
            ->get();
        $this->lessonMaterialCategory = $lessonMaterial->category->id;
    }

    public function render()
    {
        return view('livewire.lesson-material.edit');
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

    public function update()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->lessonMaterial->update([
                'title' => trim($this->title),
                'slug' => null,
                'summary' => $this->summary,
                'content' => $this->content,
                'youtubeUrl' => $this->youtubeUrl,
                'lesson_material_category_id' => $this->lessonMaterialCategory,
                'user_id' => auth()->id()
            ]);

            foreach ($this->attachments as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/lesson-materials', $filename, 'public');

                $this->lessonMaterial->files()->create([
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
                    'text' => __(':1 updated successfully', ['1' => __('Lesson Material')])
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
