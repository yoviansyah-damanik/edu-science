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
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ __('Reflection') }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <livewire:lesson-plan.identify :$lessonPlan withPrintButton :title="__('Reflection')" />

    @if ($lessonPlan->user_id == auth()->id())
        <div data-no-print>
            @if ($lessonPlan->reflection)
                <flux:callout variant="success" icon="exclamation-circle" :heading="__('Successfully')"
                    :text="__('You have added a enrichment and remedial for this lesson plan.')" inline>
                    <x-slot name="actions">
                        <flux:modal.trigger name="update-reflection-modal">
                            <flux:button variant="primary" color="green">
                                {{ __('Edit') }}
                            </flux:button>
                        </flux:modal.trigger>
                    </x-slot>
                </flux:callout>
            @else
                <flux:callout variant="warning" icon="exclamation-circle" :heading="__('Attention')"
                    :text="__('You have not added enrichment and remedial for this lesson plan.')" inline>
                    <x-slot name="actions">
                        <flux:modal.trigger name="update-reflection-modal">
                            <flux:button variant="primary" color="yellow">
                                {{ __('Add') }}
                            </flux:button>
                        </flux:modal.trigger>
                    </x-slot>
                </flux:callout>
            @endif
        </div>
    @endif

    @if ($lessonPlan->reflection)
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Student Reflections') }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $lessonPlan->reflection->student !!}
            </flux:callout.text>
        </flux:callout>
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Teacher Reflections') }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $lessonPlan->reflection->teacher !!}
            </flux:callout.text>
        </flux:callout>
    @endif

    <div data-no-print>
        <flux:modal name="update-reflection-modal" class="w-full max-w-6xl">
            <livewire:lesson-plan.update-reflection :$lessonPlan />
        </flux:modal>
    </div>
</div>
