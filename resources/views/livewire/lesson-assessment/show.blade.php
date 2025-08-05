<div class="space-y-6" data-area="print">
    <flux:breadcrumbs data-no-print>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate>
            {{ __('Home') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            <flux:dropdown>
                <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" />
                <flux:navmenu>
                    <flux:navmenu.item>
                        {{ $lessonPlan->year }}
                    </flux:navmenu.item>
                    <flux:navmenu.item>
                        {{ __(Str::title($lessonPlan->semester)) }}
                    </flux:navmenu.item>
                    <flux:navmenu.item icon="arrow-turn-down-right" :href="route('index', $lessonPlan)" wire:navigate>
                        {{ __('Lesson Plans') }}:
                        {{ $lessonPlan->title }}
                    </flux:navmenu.item>
                    @if ($lessonPlan->user_id == auth()->id())
                        <flux:navmenu.item icon="arrow-turn-down-right"
                            :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                            {{ __('Lesson Materials') }}
                        </flux:navmenu.item>
                    @else
                        <flux:navmenu.item>
                            {{ __('Lesson Materials') }}
                        </flux:navmenu.item>
                    @endif
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        @if ($lessonPlan->user_id == auth()->id())
            <flux:breadcrumbs.item
                :href="route('lesson-assessments.index', ['lessonPlan' => $lessonPlan, 'lessonMaterial' => $lessonMaterial])"
                wire:navigate>
                {{ __('Assessments') }}
            </flux:breadcrumbs.item>
        @else
            <flux:breadcrumbs.item>
                {{ __('Assessments') }}
            </flux:breadcrumbs.item>
        @endif
        <flux:breadcrumbs.item>
            {{ __('Assessment') . ' #' . $lessonAssessment->material->order }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-lesson-assessment.show :$lessonAssessment :$lessonPlan />

    <div>
        <flux:modal name="delete-lesson-assessment-modal" class="w-full max-w-xl">
            <livewire:lesson-assessment.delete lazy />
        </flux:modal>
    </div>
</div>
