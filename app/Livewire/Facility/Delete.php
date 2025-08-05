<?php

namespace App\Livewire\Facility;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FacilitiesInfrastructure;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Delete extends Component
{
    public FacilitiesInfrastructure $facility;

    public function render()
    {
        return view('livewire.facility.delete');
    }

    #[On('setDeleteFacility')]
    public function setDeleteFacility(FacilitiesInfrastructure $facility)
    {
        $this->facility = $facility;
        Flux::modal('delete-facility-modal')
            ->show();
    }

    public function delete()
    {
        try {
            $this->facility->delete();
            $this->dispatch('refreshFacilities');
            Flux::modals()->close();
            LivewireAlert::title(__('Successfully'))
                ->text(__(':1 deleted successfully', ['1' => __('Facility/Infrastructure')]))
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
