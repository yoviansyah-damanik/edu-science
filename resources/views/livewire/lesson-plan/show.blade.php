<div class="space-y-6" data-area="print">
    <flux:breadcrumbs data-no-print>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate>
            {{ __('Home') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ $lessonPlan->year }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ __(Str::title($lessonPlan->semester)) }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('index', $lessonPlan)" wire:navigate>
            {{ __('Lesson Plans') }}:
            {{ $lessonPlan->title }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-lesson-plan.show :$lessonPlan />

</div>
