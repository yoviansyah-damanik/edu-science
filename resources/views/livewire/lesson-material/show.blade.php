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
        @if ($lessonPlan->user_id == auth()->id())
            <flux:breadcrumbs.item :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
                {{ __('Lesson Materials') }}
            </flux:breadcrumbs.item>
        @else
            <flux:breadcrumbs.item>
                {{ __('Lesson Materials') }}
            </flux:breadcrumbs.item>
        @endif
        <flux:breadcrumbs.item>
            {{ $lessonMaterial->title }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <x-lesson-material.show :$lessonMaterial :$lessonPlan />

    <div>
        <flux:modal name="show-attachment-modal" class="w-full max-w-6xl">
            <livewire:attachment.show lazy />
        </flux:modal>
        <flux:modal name="delete-lesson-material-modal" class="w-full max-w-xl">
            <livewire:lesson-material.delete lazy />
        </flux:modal>
    </div>
</div>
