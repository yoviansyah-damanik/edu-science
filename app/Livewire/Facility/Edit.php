<?php

namespace App\Livewire\Facility;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FacilitiesInfrastructure;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{
    public FacilitiesInfrastructure $facility;
    public $name;

    public function render()
    {
        return view('livewire.facility.edit');
    }

    #[On('setEditFacility')]
    public function setEditFacility(FacilitiesInfrastructure $facility)
    {
        $this->facility = $facility;
        $this->name = $facility->name;

        Flux::modal('edit-facility-modal')
            ->show();
    }

    public function update()
    {
        try {
            $this->facility->update([
                'name' => $this->name
            ]);

            $this->dispatch('refreshFacilities');
            $this->reset();
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
