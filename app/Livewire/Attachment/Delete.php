<?php

namespace App\Livewire\Attachment;

use Flux\Flux;
use App\Models\File;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\MagicHelper;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public $item;
    public function render()
    {
        return view('livewire.attachment.delete');
    }

    public function placeholder()
    {
        return view('placeholders.paragraph');
    }

    #[On('setDeleteLessonMaterial')]
    public function setDeleteLessonMaterial(File $item)
    {
        $this->item = $item;
        Flux::modal('delete-attachment-modal')
            ->show();
    }

    public function delete()
    {
        $deleteFile = MagicHelper::delete($this->item->url);
        if ($deleteFile === true) {
            $this->item->delete();
            LivewireAlert::title(__('Successfully'))
                ->text(__('Changes saved successfully.'))
                ->success()
                ->show();

            $this->js("document.getElementById('" . $this->item->id . "').remove()");
        } else {
            LivewireAlert::title(__('Attention'))
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $deleteFile . ' (' . __('Filename') . ': ' . $this->item->filename . ')')
                ->error()
                ->show();
        }

        Flux::modals()
            ->close();
    }
}
