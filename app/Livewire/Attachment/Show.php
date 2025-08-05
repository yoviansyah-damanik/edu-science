<?php

namespace App\Livewire\Attachment;

use Flux\Flux;
use App\Models\File;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\MagicHelper;
use Livewire\Attributes\Reactive;

class Show extends Component
{
    public $item;
    public function render()
    {
        return view('livewire.attachment.show');
    }

    public function placeholder()
    {
        return view('placeholders.block');
    }

    #[On('setShowLessonMaterial')]
    public function setShowLessonMaterial(File $item)
    {
        $this->item = $item;
        Flux::modal('show-attachment-modal')
            ->show();
    }

    public function download()
    {
        return MagicHelper::download($this->item->url, $this->item->filename);
    }
}
