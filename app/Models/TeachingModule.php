<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TeachingModule extends Model
{
    protected $guarded = ['id'];

    public function initialCompetencies(): HasMany
    {
        return $this->hasMany(InitialCompetency::class);
    }

    public function profileOfPancasilas(): HasMany
    {
        return $this->hasMany(ProfileOfPancasila::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
    public function objectives(): HasMany
    {
        return $this->hasMany(Objective::class);
    }
    public function understandings(): HasMany
    {
        return $this->hasMany(Understanding::class);
    }
    public function triggerQuestions(): HasMany
    {
        return $this->hasMany(TriggerQuestion::class);
    }

    public function facilitiesInfrastructures(): HasManyThrough
    {
        return $this->HasManyThrough(
            FacilitiesInfrastructure::class,
            TeachingModuleHasFacilitiesInfrastructure::class,
            'teaching_module_id',
            'id',
            'id',
            'facilities_infrastructure_id'
        );
    }

    public function hasFacilitiesInfrastructures(): HasMany
    {
        return $this->hasMany(TeachingModuleHasFacilitiesInfrastructure::class);
    }
}
