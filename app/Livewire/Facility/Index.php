<?php

namespace App\Livewire\Facility;

use App\Models\FacilitiesInfrastructure;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $listeners = ['refreshFacilities' => '$refresh'];

    public string $search = '';
    public int $perPage = 10;

    public function render()
    {
        $items = FacilitiesInfrastructure::whereLike('name', "%$this->search%")
            ->paginate($this->perPage);

        return view('livewire.facility.index', compact('items'));
    }

    public function refresh()
    {
        $this->search = '';
        $this->resetPage();
    }
}
