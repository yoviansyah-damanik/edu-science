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
                    <flux:navmenu.item icon="arrow-turn-down-right" :href="route('index', $lessonPlan)" wire:navigate>
                        {{ __('Lesson Plans') }}:
                        {{ $lessonPlan->title }}
                    </flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>
            {{ __('Lesson Materials') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Edit') }}: {{ $lessonMaterial->title }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="secondary" class="space-y-6">
        <div class="grid lg:grid-cols-3 gap-4 align-top">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Lesson Material Category') }}</flux:label>
                <flux:select wire:model="lessonMaterialCategory">
                    @foreach ($lessonMaterialCategories as $item)
                        <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
            <flux:field class="lg:col-span-2">
                <flux:label :badge="__('Required')">{{ __('Title') }}</flux:label>
                <flux:input wire:model="title" type="text" clearable />
            </flux:field>
            <flux:field class="lg:col-span-3">
                <flux:label :badge="__('Required')">{{ __('Content') }}</flux:label>
                <x-textarea-wysiwyg wire:model="content" :attachmentButton="true" />
            </flux:field>
            <flux:field class="lg:col-span-3">
                <flux:label :badge="__('Required')">{{ __('Summary') }}</flux:label>
                <flux:textarea rows="auto" wire:model="summary" resize="vertical" />
            </flux:field>
            <flux:field class="lg:col-span-3">
                <flux:label
                    :badge="__('Optional').
                    ' | '.
                    'Max: 2048kb | '.__('Multiple')">
                    {{ __('Attachment') }}
                </flux:label>
                <flux:input type="file" wire:model="attachments" multiple />
            </flux:field>
            @if ($lessonMaterial->files->count() > 0)
                <div class="col-span-3">
                    <livewire:attachment.index :items="$lessonMaterial->files" :name="'lessonMaterialAttachments-' . $lessonMaterial->id"
                        wire:key="lessonMaterialAttachments-{{ $lessonMaterial->id }}" inline deleted />
                </div>
            @endif
        </div>

    </flux:callout>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" icon="save" wire:click="update" wire:loading.attr="disabled"
            wire:target="attachments">
            {{ __('Save') }}
        </flux:button>

        @if ($errors->all())
            <flux:icon.triangle-alert variant="mini" />
            <flux:text>
                {{ __('Please double check your entries') . '. ' . $errors->first() }}
            </flux:text>
        @endif
    </div>

    <div>
        <flux:modal name="show-attachment-modal" class="w-full max-w-6xl">
            <livewire:attachment.show />
        </flux:modal>

        <flux:modal name="delete-attachment-modal" class="w-full max-w-xl">
            <livewire:attachment.delete />
        </flux:modal>
    </div>
</div>
