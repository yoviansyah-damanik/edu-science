<div class="space-y-6">
    <flux:breadcrumbs>
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
                    <flux:navmenu.item icon="arrow-turn-down-right" :href="route('index',$lessonPlan->id)" wire:navigate>
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
        <flux:breadcrumbs.item
            :href="route('lesson-assessments.index', ['lessonPlan' => $lessonPlan, 'lessonMaterial' => $lessonMaterial])"
            wire:navigate>
            {{ __('Assessments') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Create') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="secondary">
        <flux:text class="space-y-6">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Assessment') }}</flux:label>
                <x-textarea-wysiwyg wire:model="assessment" />
            </flux:field>
        </flux:text>
    </flux:callout>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" icon="save" wire:click="update" wire:loading.attr="disabled">
            {{ __('Save') }}
        </flux:button>

        @if ($errors->all())
            <flux:icon.triangle-alert variant="mini" />
            <flux:text>
                {{ __('Please double check your entries') . '. ' . $errors->first() }}
            </flux:text>
        @endif
    </div>

</div>
