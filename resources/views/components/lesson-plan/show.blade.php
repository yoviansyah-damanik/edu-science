<div class="space-y-6">
    @if (!$showOnly)
        <livewire:lesson-plan.identify :$lessonPlan withPrintButton :title="__('Teaching Module')" />
    @endif

    @if ($lessonPlan->teachingModule)
        {{-- Data Dasar --}}
        <flux:callout>
            {{-- Kompetensi Dasar --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Initial Competencies') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->initialCompetencies as $competency)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $competency->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>

            {{-- Sarana/Prasarana --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Facilities') . '/' . __('Infrastructures') }}
                </flux:callout.heading>

                <flux:text class="md:grid md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($lessonPlan->teachingModule->facilitiesInfrastructures as $facilitiesInfrastructure)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $facilitiesInfrastructure->name }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>

            {{-- Model Pembelajaran --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Lesson Model') }}
                </flux:callout.heading>

                <flux:text class="md:grid md:grid-cols-2 lg:grid-cols-3">
                    {{ $lessonPlan->teachingModule->lesson_model }}
                </flux:text>
            </flux:callout>

            {{-- Profil Pelajar Pancasila --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Profile of Pancasila Students') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->targets as $target)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $target->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>

            {{-- Target Peserta Didik --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Target Students') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->profileOfPancasilas as $profileOfPancasila)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $profileOfPancasila->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>
        </flux:callout>

        {{-- Kompetensi Inti --}}
        <flux:callout>
            <flux:callout.heading>
                {{ __('Core Competency') }}
            </flux:callout.heading>

            {{-- Kompetensi Inti --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Lesson Objectives') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->objectives as $objective)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $objective->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>

            {{-- Pemahaman Bermakna --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Meaningful Understandings') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->understandings as $understanding)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $understanding->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>

            {{-- Pemahaman Bermakna --}}
            <flux:callout variant="secondary">
                <flux:callout.heading icon="folder-open">
                    {{ __('Trigger Questions') }}
                </flux:callout.heading>

                <flux:text>
                    @foreach ($lessonPlan->teachingModule->triggerQuestions as $triggerQuestion)
                        <div class="flex gap-2 items-start">
                            <flux:icon.check class="text-green-500 size-4" />
                            {{ $triggerQuestion->text }}
                        </div>
                    @endforeach
                </flux:text>
            </flux:callout>
        </flux:callout>
    @endif
</div>
