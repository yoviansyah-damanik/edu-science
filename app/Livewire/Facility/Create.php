<?php

namespace App\Livewire\Facility;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FacilitiesInfrastructure;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.facility.create');
    }

    #[On('setCreateFacility')]
    public function setCreateFacility()
    {
        Flux::modal('create-facility-modal')
            ->show();
    }

    public function store()
    {
        try {
            FacilitiesInfrastructure::create([
                'name' => $this->name
            ]);

            $this->reset();
            $this->dispatch('refreshFacilities');
            Flux::modals()->close();
            LivewireAlert::title(__('Successfully'))
                ->text(__(':1 saved successfully', ['1' => __('Facility/Infrastructure')]))
                ->success()
                ->timer(0)
                ->show();
        } catch (\Exception $e) {
            LivewireAlert::title(__('Attention') . '!')
                ->text(__('An error occurred while processing the data') . '. ' . __('Message') . ': ' . $e->getMessage())
                ->error()
                ->timer(0)
                ->show();
        }
    }
}
