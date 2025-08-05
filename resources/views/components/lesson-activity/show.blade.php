<div class="space-y-6">
    @if (!$showOnly)
        <livewire:lesson-plan.identify withPrintButton :$lessonPlan :withLetterhead="false" :title="__('Lesson Activity') . ' #' . $lessonActivity->material->order" />
    @endif

    <div class="gap-3 [&>*:not(:last-child)]:me-3 text-sm [&>*]:inline-flex [&>*]:gap-1 [&>*]:items-center">
        <div>
            <flux:icon.clock class="size-4" />
            {{ $lessonActivity->created_at->format('d/m/Y H:i:s') }}
        </div>
        @if (!$showOnly)
            @if ($lessonPlan->user_id == auth()->id())
                <flux:link wire:navigate
                    :href="route('lesson-activities.edit', ['lessonPlan' => $lessonPlan, 'lessonActivity' =>
                        $lessonActivity
                    ])"
                    data-no-print>
                    <flux:icon.pencil-line class="size-4" />
                    {{ __('Edit') }}
                </flux:link>
                <flux:link class="cursor-pointer"
                    wire:click="$dispatch('setDeleteLessonActivity',{ lessonActivity: '{{ $lessonActivity->id }}', isRefresh:true})"
                    data-no-print>
                    <flux:icon.trash class="size-4" />
                    {{ __('Delete') }}
                </flux:link>
            @endif
        @else
            <flux:link wire:navigate
                :href="route('lesson-activities.show', ['lessonPlan' => $lessonPlan, 'lessonActivity' => $lessonActivity])"
                data-no-print>
                <flux:icon.eye class="size-4" />
                {{ __('Show More') }}
            </flux:link>
        @endif
    </div>

    <flux:callout variant="secondary">
        <flux:callout.heading class="mb-4">
            {{ __('Introduction') . ' (' . $lessonActivity->introduction_time . ' ' . __('Minutes') . ')' }}
        </flux:callout.heading>
        <flux:callout.text>
            {!! $lessonActivity->introduction !!}
        </flux:callout.text>
    </flux:callout>
    @if (!$showOnly)
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Core') . ' (' . $lessonActivity->core_time . ' ' . __('Minutes') . ')' }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $lessonActivity->core !!}
            </flux:callout.text>
        </flux:callout>
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Closing') . ' (' . $lessonActivity->closing_time . ' ' . __('Minutes') . ')' }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $lessonActivity->closing !!}
            </flux:callout.text>
        </flux:callout>
    @endif
</div>
