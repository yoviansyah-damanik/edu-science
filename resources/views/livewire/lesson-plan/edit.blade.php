<div class="space-y-6" x-data="{
    initialCompetencies: @entangle('initialCompetencies'),
    profileOfPancasilas: @entangle('profileOfPancasilas'),
    targets: @entangle('targets'),
    objectives: @entangle('objectives'),
    understandings: @entangle('understandings'),
    triggerQuestions: @entangle('triggerQuestions'),
}">
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
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('index',$lessonPlan->id)" wire:navigate>
            {{ __('Lesson Plans') }}:
            {{ $lessonPlan->title }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Edit') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="secondary" class="space-y-6">
        <flux:callout.heading class="!mb-6">
            {{ __('General Information') }}
        </flux:callout.heading>
        <div class="grid lg:grid-cols-6 grid-cols-2 gap-4 align-top">
            <flux:field class="col-span-2 lg:col-span-6">
                <flux:label :badge="__('Required')">{{ __('Title') }}</flux:label>
                <flux:input wire:model="title" type="text" clearable />
            </flux:field>
            <flux:field class="col-span-1">
                <flux:label :badge="__('Required')">{{ __('Phase') }}</flux:label>
                <flux:select wire:model="phase">
                    @foreach ($phases as $item)
                        <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
            <flux:field class="col-span-1">
                <flux:label :badge="__('Required')">{{ __('Class') }}</flux:label>
                <flux:select wire:model="class">
                    @foreach ($classes as $item)
                        <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
            <flux:field class="col-span-1">
                <flux:label :badge="__('Required')">{{ __('Subject') }}</flux:label>
                <flux:input wire:model="subject" type="text" />
            </flux:field>
            <flux:field class="col-span-1">
                <flux:label :badge="__('Required')">{{ __('Subject Element') }}</flux:label>
                <flux:input wire:model="subjectElement" type="text" />
            </flux:field>
            <flux:field class="col-span-2">
                <flux:label :badge="__('Required')">{{ __('Time Allocation') }}</flux:label>
                <flux:input wire:model="timeAllocation" type="text" />
            </flux:field>
            <flux:field class="col-span-2 lg:col-span-6">
                <flux:label :badge="__('Required')">{{ __('Lesson Model') }}</flux:label>
                <flux:input wire:model="lessonModel" type="text" />
            </flux:field>
            <flux:field class="col-span-2 lg:col-span-6">
                <flux:label :badge="__('Required')">{{ __('Initial Competencies') }}</flux:label>

                <template x-for="(item, index) in initialCompetencies" :key="index">
                    <flux:input.group>
                        <flux:input type="text" x-model="initialCompetencies[index]" />
                        <flux:button variant="danger" icon="trash" @click="initialCompetencies.splice(index, 1)" />
                    </flux:input.group>
                </template>

                <flux:button variant="primary" icon="plus" @click="initialCompetencies.push('')">
                    {{ __('New :1', ['1' => __('Initial Competency')]) }}
                </flux:button>
            </flux:field>
            <flux:field class="col-span-2 md:col-span-6">
                <flux:label :badge="__('Required')">
                    {{ __('Facilities') . '/' . __('Infrastructures') }}
                </flux:label>
                <flux:checkbox.group wire:model="facilities"
                    class="col-span-2 md:col-span-6 [&>*]:md:!inline-flex [&>*:not(:last-child)]:md:!me-3">
                    @foreach ($facilitiesList as $item)
                        <flux:checkbox :value="$item->id" :label="$item->name" />
                    @endforeach
                </flux:checkbox.group>
            </flux:field>
            <flux:field class="col-span-2 lg:col-span-6">
                <flux:label :badge="__('Required')">{{ __('Profile of Pancasila Student') }}</flux:label>

                <template x-for="(item, index) in profileOfPancasilas" :key="index">
                    <flux:input.group>
                        <flux:input type="text" x-model="profileOfPancasilas[index]" />
                        <flux:button variant="danger" icon="trash" @click="profileOfPancasilas.splice(index, 1)" />
                    </flux:input.group>
                </template>

                <flux:button variant="primary" icon="plus" @click="profileOfPancasilas.push('')">
                    {{ __('New :1', ['1' => __('Profile of Pancasila Student')]) }}
                </flux:button>
            </flux:field>
            <flux:field class="col-span-2 lg:col-span-6">
                <flux:label :badge="__('Required')">{{ __('Target Students') }}</flux:label>

                <template x-for="(item, index) in targets" :key="index">
                    <flux:input.group>
                        <flux:input type="text" x-model="targets[index]" />
                        <flux:button variant="danger" icon="trash" @click="targets.splice(index, 1)" />
                    </flux:input.group>
                </template>

                <flux:button variant="primary" icon="plus" @click="targets.push('')">
                    {{ __('New :1', ['1' => __('Target Student')]) }}
                </flux:button>
            </flux:field>
        </div>

    </flux:callout>
    <flux:callout variant="secondary" class="space-y-6">
        <flux:callout.heading class="!mb-6">
            {{ __('Core Competency') }}
        </flux:callout.heading>
        <flux:field class="col-span-2 lg:col-span-6">
            <flux:label :badge="__('Required')">{{ __('Lesson Objectives') }}</flux:label>

            <template x-for="(item, index) in objectives" :key="index">
                <flux:input.group>
                    <flux:input type="text" x-model="objectives[index]" />
                    <flux:button variant="danger" icon="trash" @click="objectives.splice(index, 1)" />
                </flux:input.group>
            </template>

            <flux:button variant="primary" icon="plus" @click="objectives.push('')">
                {{ __('New :1', ['1' => __('Lesson Objective')]) }}
            </flux:button>
        </flux:field>
        <flux:field class="col-span-2 lg:col-span-6">
            <flux:label :badge="__('Required')">{{ __('Meaningful Understandings') }}</flux:label>

            <template x-for="(item, index) in understandings" :key="index">
                <flux:input.group>
                    <flux:input type="text" x-model="understandings[index]" />
                    <flux:button variant="danger" icon="trash" @click="understandings.splice(index, 1)" />
                </flux:input.group>
            </template>

            <flux:button variant="primary" icon="plus" @click="understandings.push('')">
                {{ __('New :1', ['1' => __('Meaningful Understanding')]) }}
            </flux:button>
        </flux:field>
        <flux:field class="col-span-2 lg:col-span-6">
            <flux:label :badge="__('Required')">{{ __('Trigger Questions') }}</flux:label>

            <template x-for="(item, index) in triggerQuestions" :key="index">
                <flux:input.group>
                    <flux:input type="text" x-model="triggerQuestions[index]" />
                    <flux:button variant="danger" icon="trash" @click="triggerQuestions.splice(index, 1)" />
                </flux:input.group>
            </template>

            <flux:button variant="primary" icon="plus" @click="triggerQuestions.push('')">
                {{ __('New :1', ['1' => __('Trigger Question')]) }}
            </flux:button>
        </flux:field>
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
