<?php

namespace App\Livewire\LessonMaterial;

use Flux\Flux;
use App\Models\File;
use Livewire\Component;
use App\Models\LessonPlan;
use Livewire\Attributes\On;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\Cookie;

class Show extends Component
{
    public LessonMaterial $lessonMaterial;
    public bool $isShowOnly;
    public LessonPlan $lessonPlan;

    public function mount(LessonPlan $lessonPlan, LessonMaterial $lessonMaterial, bool $isShowOnly = false) {}

    public function render()
    {
        return view('livewire.lesson-material.show');
    }

    #[On('setAttachment')]
    public function setAttachment(File $item, string $type)
    {
        $availableType = ['show', 'delete', 'download'];

        if (!in_array($type, $availableType)) {
            throw new \InvalidArgumentException("{$type} tidak tersedia. Tipe yang tersedia: " . implode(', ', $availableType));
        }

        if ($type == "show") {
            $this->dispatch('setShowLessonMaterial', $item->id);
            Flux::modal('show-attachment-modal')
                ->show();
        } elseif ($type == "delete") {
            $this->dispatch('setDeleteLessonMaterial', $item->id);
            Flux::modal('delete-attachment-modal')
                ->show();
        }
    }
}
