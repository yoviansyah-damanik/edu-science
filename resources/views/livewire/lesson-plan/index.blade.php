<div class="space-y-6" x-data="{
    tabOpen: 1,
    disableButton(el) {
        if (el) el.disabled = true;
    },
    init() {
        this.setDisabled(1);
    },
    setDisabled(value) {
        // Disable semua tombol dengan atribut [data-tab-open]
        document.querySelectorAll('[data-tab-open]').forEach(el => el.disabled = false);

        // Aktifkan kembali tombol yang sesuai dengan ID
        this.disableButton(document.getElementById(`tabOpen-${value}`))
    }
}" x-init="$watch('tabOpen', value => setDisabled(value))">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate>
            {{ __('Home') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ $lessonPlan->year }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ __(Str::title($lessonPlan->semester)) }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ __('Lesson Plans') }}:
            {{ $lessonPlan->title }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="" data-area="page-title">
        <div class="flex gap-3 items-center">
            <flux:icon.file-text />
            <flux:heading size="xl" level="1">
                {{ __('Lesson Plans') }} ({{ __('LPs') }})
            </flux:heading>
        </div>
    </div>

    <div class="" data-area="identify">
        <livewire:lesson-plan.identify :$lessonPlan withEditButton withShowButton />
    </div>

    <div class="flex flex-col lg:flex-row gap-6 lg:min-h-[600px]">
        {{-- Nav --}}
        <div class="min-w-60 flex lg:flex-col flex-row overflow-auto gap-4 [&>*]:py-2 [&>*]:text-center snap-x lg:border-r md:pe-6"
            data-area="links">
            <flux:button x-on:click="tabOpen = 1" data-tab-open id="tabOpen-1" variant="primary" class="snap-start">
                {{ __('Teaching Module') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 2" data-tab-open id="tabOpen-2" variant="primary" class="snap-start">
                {{ __('Lesson Materials') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 3" data-tab-open id="tabOpen-3" variant="primary" class="snap-start">
                {{ __('Lesson Activities') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 4" data-tab-open id="tabOpen-4" variant="primary" class="snap-start">
                {{ __('SWs') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 5" data-tab-open id="tabOpen-5" variant="primary" class="snap-start">
                {{ __('Assessment') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 6" data-tab-open id="tabOpen-6" variant="primary" class="snap-start">
                {{ __('Lesson Reflection') }}
            </flux:button>
            <flux:button x-on:click="tabOpen = 7" data-tab-open id="tabOpen-7" variant="primary" class="snap-start">
                {{ __('Evaluation') }}
            </flux:button>
        </div>
        {{-- Body --}}
        <div class="[&>*]:space-y-6 flex-1" data-area="body">
            <div x-show="tabOpen == 1">
                <x-lesson-plan.show :$lessonPlan showOnly />
            </div>
            <div x-show="tabOpen == 2">
                @if ($lessonPlan->user_id == auth()->id())
                    <div class="flex items-center gap-3">
                        <flux:button variant="primary" :href="route('lesson-materials.create', $lessonPlan)"
                            icon="plus" wire:navigate>
                            {{ __('New :1', ['1' => __('Lesson Material')]) }}
                        </flux:button>
                        <flux:button :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                            {{ __('List of :1', ['1' => __('Lesson Material')]) }}
                        </flux:button>
                    </div>
                @endif

                @foreach ($lessonPlan->materials as $lessonMaterial)
                    <flux:callout variant="secondary">
                        <x-lesson-material.show :$lessonPlan :$lessonMaterial showOnly />
                    </flux:callout>
                @endforeach
            </div>
            <div x-show="tabOpen == 3">
                @if ($lessonPlan->user_id == auth()->id())
                    <flux:text class="flex items-start gap-3 flex-col md:flex-row">
                        {{ __('You can add lesson activities to the lesson material menu.') }}
                        <div>
                            <flux:link :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                                {{ __('Click here') }}
                            </flux:link>
                            {{ __('or') }}
                            <flux:link :href="route('student-worksheet.index', $lessonPlan)" wire:navigate>
                                {{ __('Show') . ' ' . __('List of :1', ['1' => __('Lesson Activities')]) }}.
                            </flux:link>
                        </div>
                    </flux:text>
                @endif

                @foreach ($lessonPlan->lessonActivities as $activity)
                    <flux:callout variant="primary">
                        <x-lesson-activity.show :$lessonPlan :lessonActivity="$activity" showOnly />
                    </flux:callout>
                @endforeach
            </div>
            <div x-show="tabOpen == 4">
                @if ($lessonPlan->user_id == auth()->id())
                    <flux:text class="flex items-start gap-3 flex-col md:flex-row">
                        {{ __('You can add assessments to the lesson material menu.') }}
                        <div>
                            <flux:link :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                                {{ __('Click here') }}
                            </flux:link>
                            {{ __('or') }}
                            <flux:link :href="route('student-worksheet.index', $lessonPlan)" wire:navigate>
                                {{ __('Show') . ' ' . __('List of :1', ['1' => __('SWs')]) }}.
                            </flux:link>
                        </div>

                    </flux:text>
                @endif

                @foreach ($lessonPlan->studentWorksheets as $studentWorksheet)
                    <flux:callout variant="primary">
                        <x-student-worksheet.show :$lessonPlan :studentWorksheet="$studentWorksheet" showOnly />
                    </flux:callout>
                @endforeach
            </div>
            <div x-show="tabOpen == 5">
                @if ($lessonPlan->user_id == auth()->id())
                    <flux:text class="flex items-start gap-3 flex-col md:flex-row">
                        {{ __('You can add student worksheets to the lesson material menu.') }}
                        <div>
                            <flux:link :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                                {{ __('Click here') }}
                            </flux:link>
                            {{ __('or') }}
                            <flux:link :href="route('student-worksheet.index', $lessonPlan)" wire:navigate>
                                {{ __('Show') . ' ' . __('List of :1', ['1' => __('Assessments')]) }}.
                            </flux:link>
                        </div>

                    </flux:text>
                @endif

                @if ($lessonPlan->assessment)
                    <flux:callout variant="success" icon="check-circle" :heading="__('Successfully')"
                        :text="__('You have added enrichment and remedial for this lesson plan.')" inline>
                        <x-slot name="actions">
                            <flux:button variant="primary" color="green"
                                :href="route('assessment', ['lessonPlan' => $lessonPlan])" wire:navigate>
                                {{ __('Show More') }}
                            </flux:button>
                        </x-slot>
                    </flux:callout>
                @else
                    <flux:callout variant="warning" icon="exclamation-circle" :heading="__('Attention')"
                        :text="__('You have not added enrichment and remedial for this lesson plan.')" inline>
                        <x-slot name="actions">
                            <flux:button variant="primary" color="yellow"
                                :href="route('assessment', ['lessonPlan' => $lessonPlan])" wire:navigate>
                                {{ __('Show More') }}
                            </flux:button>
                        </x-slot>
                    </flux:callout>
                @endif

                @foreach ($lessonPlan->lessonAssessments as $lessonAssessment)
                    <flux:callout variant="primary">
                        <x-lesson-assessment.show :$lessonPlan :lessonAssessment="$lessonAssessment" showOnly />
                    </flux:callout>
                @endforeach
            </div>
            <div x-show="tabOpen == 6">
                @if ($lessonPlan->reflection)
                    <flux:callout variant="success" icon="check-circle" :heading="__('Successfully')"
                        :text="__('You have added a reflection for this lesson plan.')" inline>
                        <x-slot name="actions">
                            <flux:button variant="primary" color="green"
                                :href="route('reflection', ['lessonPlan' => $lessonPlan])" wire:navigate>
                                {{ __('Show More') }}
                            </flux:button>
                        </x-slot>
                    </flux:callout>
                @else
                    <flux:callout variant="warning" icon="exclamation-circle" :heading="__('Attention')"
                        :text="__('You have not added reflection for this lesson plan.')" inline>
                        <x-slot name="actions">
                            <flux:button variant="primary" color="yellow"
                                :href="route('reflection', ['lessonPlan' => $lessonPlan])" wire:navigate>
                                {{ __('Show More') }}
                            </flux:button>
                        </x-slot>
                    </flux:callout>
                @endif
            </div>
            <div x-show="tabOpen == 7" class="space-y-6">
                @if ($lessonPlan->evaluation)
                    <flux:callout variant="success" icon="check-circle" :heading="__('Successfully')"
                        :text="__('You have added an evaluation for this lesson plan.')" inline>
                        <x-slot name="actions">
                            <flux:button variant="primary" color="green"
                                :href="route('evaluation.show', ['lessonPlan' => $lessonPlan])" wire:navigate>
                                {{ __('Show More') }}
                            </flux:button>
                        </x-slot>
                    </flux:callout>

                    <livewire:evaluation.score showOnly :evaluation="$lessonPlan->evaluation" />
                @else
                    <flux:callout variant="warning" icon="exclamation-circle" :heading="__('Attention')"
                        :text="__('You have not added any reviews yet.')" inline>
                        @if (auth()->user()->id == $lessonPlan->user_id)
                            <x-slot name="actions">
                                <flux:button variant="primary" color="yellow"
                                    :href="route('evaluation.create', $lessonPlan)" wire:navigate>
                                    {{ __('Add :1', ['1' => __('Evaluation')]) }}
                                </flux:button>
                            </x-slot>
                        @endif
                    </flux:callout>
                @endif
            </div>
        </div>
    </div>
    <div>
        <flux:modal name="show-attachment-modal" class="w-full max-w-6xl">
            <livewire:attachment.show lazy />
        </flux:modal>
    </div>
</div>
