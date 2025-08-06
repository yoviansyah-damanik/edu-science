<?php

namespace App\Livewire\Attachment;

use Livewire\Component;
use App\Helpers\MagicHelper;

class Item extends Component
{
    public $item;
    public bool $deleted;
    public function mount($item, bool $deleted)
    {
        $this->deleted = ($item->user_id == auth()->id()) || $deleted;
    }

    public function render()
    {
        return view('livewire.attachment.item');
    }

    public function download()
    {
        return MagicHelper::download($this->item->url, $this->item->filename);
    }

    public function delete()
    {
        $this->dispatch('setDeleteLessonMaterial', $this->item->id);
    }

    public function show()
    {
        $this->dispatch('setShowLessonMaterial', $this->item->id);
    }
}
