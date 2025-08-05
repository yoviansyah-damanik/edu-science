<div class="space-y-6">
    @if (!$showOnly)
        <livewire:lesson-plan.identify withPrintButton :$lessonPlan :withLetterhead="false" :title="__('Assessment') . ' #' . $lessonAssessment->material->order" />
    @endif

    <div class="gap-3 [&>*:not(:last-child)]:me-3 text-sm [&>*]:inline-flex [&>*]:gap-1 [&>*]:items-center">
        <div>
            <flux:icon.check class="size-4" />
            {{ __('Meeting Assessment #:1', ['1' => $lessonAssessment->material->order]) }}
        </div>
        <div>
            <flux:icon.clock class="size-4" />
            {{ $lessonAssessment->created_at->format('d/m/Y H:i:s') }}
        </div>
        @if (!$showOnly)
            @if ($lessonPlan->user_id == auth()->id())
                <flux:link wire:navigate
                    :href="route('lesson-assessments.edit', ['lessonPlan' => $lessonPlan, 'lessonAssessment' =>
                        $lessonAssessment
                    ])"
                    data-no-print>
                    <flux:icon.pencil-line class="size-4" />
                    {{ __('Edit') }}
                </flux:link>
                <flux:link class="cursor-pointer"
                    wire:click="$dispatch('setDeleteLessonAssessment',{ lessonAssessment: '{{ $lessonAssessment->id }}', isRefresh:true})"
                    data-no-print>
                    <flux:icon.trash class="size-4" />
                    {{ __('Delete') }}
                </flux:link>
            @endif
        @else
            <flux:link wire:navigate
                :href="route('lesson-assessments.show', ['lessonPlan' => $lessonPlan, 'lessonAssessment' => $lessonAssessment])"
                data-no-print>
                <flux:icon.eye class="size-4" />
                {{ __('Show More') }}
            </flux:link>
        @endif
    </div>

    <flux:callout variant="secondary">
        <flux:callout.heading class="mb-4">
            {{ __('Assessment') }}
        </flux:callout.heading>
        <flux:callout.text>
            {!! $lessonAssessment->assessment !!}
        </flux:callout.text>
    </flux:callout>

</div>
