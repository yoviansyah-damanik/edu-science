<?php

namespace App\Livewire\Settings;

use Illuminate\Validation\Rule;
use Livewire\Component;

class SchoolProfile extends Component
{
    public $name;
    public $address;
    public $status;
    public $accreditation;
    public $level;
    public $achievement;
    public $studyHours;
    public $postalCode;
    public $phoneNumber;
    public $email;
    public $districtName;

    public \App\Models\SchoolProfile $school;
    public $statuses;
    public $levels;
    public $accreditations;

    public function mount()
    {
        $this->statuses = [
            'Sekolah Negeri',
            'Sekolah Swasta',
            'Lain-lain'
        ];

        $this->levels = [
            'SD/MI (Kelas I - VI)',
            'SMP/MTs (Kelas VII - IX)',
            'SMA/MA (Kelas X - XII)'
        ];

        $this->accreditations = ['A', 'B', 'C', 'D'];


        $school = \App\Models\SchoolProfile::first();
        $this->school = $school;

        $this->name = $school->name;
        $this->address = $school->address;
        $this->status = $school->status;
        $this->accreditation = $school->accreditation;
        $this->level = $school->level;
        $this->achievement = $school->achievement;
        $this->studyHours = $school->study_hours;
        $this->postalCode = $school->postal_code;
        $this->phoneNumber = $school->phone_number;
        $this->email = $school->email;
        $this->districtName = $school->district_name;
    }

    public function render()
    {
        return view('livewire.settings.school-profile');
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'status' => [
                'required',
                'string',
                Rule::in($this->statuses)
            ],
            'accreditation' => [
                'required',
                'string',
                Rule::in($this->accreditations)
            ],
            'level' => [
                'required',
                'string',
                Rule::in($this->levels)
            ],
            'achievement' => 'required|string',
            'studyHours' => 'required|string',
            'postalCode' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'districtName' => 'required|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('School Name'),
            'address' => __('Address'),
            'status' => __('Status'),
            'accreditation' => __('Accreditation'),
            'level' => __('Level'),
            'achievement' => __('Achievement'),
            'studyHours' => __('Study Hours'),
            'postalCode' => __('Postal Code'),
            'phoneNumber' => __('Phone Number'),
            'email' => __('Email'),
            'districtName' => __('District Name'),
        ];
    }

    public function updateProfileInformation()
    {
        $this->validate();

        $this->school->update([
            'name' => $this->name,
            'address' => $this->address,
            'status' => $this->status,
            'accreditation' => $this->accreditation,
            'level' => $this->level,
            'achievement' => $this->achievement,
            'study_hours' => $this->studyHours,
            'postal_code' => $this->postalCode,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'district_name' => $this->districtName,
        ]);

        $this->dispatch('profile-updated', name: $this->name);
    }
}
