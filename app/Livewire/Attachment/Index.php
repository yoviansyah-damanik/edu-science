<?php

namespace App\Livewire\Attachment;

use Flux\Flux;
use App\Models\File;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

class Index extends Component
{

    public Collection $items;
    public $selectedItem;
    public bool $inline;

    public function mount(Collection $items, bool $inline = false, $deleted = false)
    {
        //
    }

    public function render()
    {
        return view('livewire.attachment.index');
    }
}
