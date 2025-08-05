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
            :href="route('lesson-activities.index', ['lessonPlan' => $lessonPlan, 'lessonMaterial' => $lessonMaterial])"
            wire:navigate>
            {{ __('Lesson Activities') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Create') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="secondary">
        <flux:text class="space-y-6">
            <div class="grid grid-cols-3 gap-4">
                <flux:field>
                    <flux:label :badge="__('Required')">{{ __('Introduction Time') . ' (' . __('Minutes') . ')' }}
                    </flux:label>
                    <flux:input wire:model="introductionTime" type="number" min=1 />
                </flux:field>
                <flux:field>
                    <flux:label :badge="__('Required')">{{ __('Core Time') . ' (' . __('Minutes') . ')' }}</flux:label>
                    <flux:input wire:model="coreTime" type="number" min=1 />
                </flux:field>
                <flux:field>
                    <flux:label :badge="__('Required')">{{ __('Closing Time') . ' (' . __('Minutes') . ')' }}
                    </flux:label>
                    <flux:input wire:model="closingTime" type="number" min=1 />
                </flux:field>
            </div>
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Introduction') }}</flux:label>
                <x-textarea-wysiwyg wire:model="introduction" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Core') }}</flux:label>
                <x-textarea-wysiwyg wire:model="core" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Closing') }}</flux:label>
                <x-textarea-wysiwyg wire:model="closing" />
            </flux:field>
        </flux:text>
    </flux:callout>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" icon="save" wire:click="store" wire:loading.attr="disabled">
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
