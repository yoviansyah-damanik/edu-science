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
        <flux:breadcrumbs.item :href="route('student-worksheet.index', $lessonPlan)" wire:navigate>
            {{ __('Student Worksheets') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Create') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="secondary" class="space-y-6">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label>{{ __('Lesson Material') }}</flux:label>
                <flux:input readonly :value="$lessonMaterial->title" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Basic Competency') }}</flux:label>
                <flux:input wire:model="basicCompetency" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Lesson Objective') }}</flux:label>
                <flux:input wire:model="basicCompetency" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Kemampuan Dasar --}}
    <flux:callout variant="secondary" class="space-y-6">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Basic Skill') }}</flux:label>
                <x-textarea-wysiwyg wire:model="basicSkill" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Diferensiasi Berdasarkan Tingkat Kemampuan --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Differentiation Based on Ability Level') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Level', ['1' => __('Basic')]) . ' (' . __('For students who need more help') . ')' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityBasic" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Level', ['1' => __('Intermediate')]) . ' (' . __('For students with average abilities') . ')' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityIntermediate" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Level', ['1' => __('Advanced')]) . ' (' . __('For students with high abilities') . ')' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityAdvanced" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Diferensiasi Berdasarkan Gaya Belajar --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Differentiation Based on Learning Styles') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Visual Learners') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="styleVisual" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Audio Learners') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="styleAudio" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Kinesthetic Learners') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="styleKinesthetic" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Diferensiasi Berdasarkan Minat --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Differentiation Based on Interest') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Students Who Like Engineering/Construction') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="interestTechnique" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Students Who Like Adventure') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="interestAdventure" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('For Students Who Like Home Economics') }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="interestHousehold" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Soal Tantangan Bertingkat --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Tiered Challenge Questions') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('Level :1 Challenge', ['1' => 1]) }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="questionLv1" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('Level :1 Challenge', ['1' => 2]) }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="questionLv2" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __('Level :1 Challenge', ['1' => 3]) }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="questionLv3" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Evaluasi --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Differentiation Based on Ability Level') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Evaluation', ['1' => __('Basic')]) . ' *' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityBasic" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Evaluation', ['1' => __('Intermediate')]) . ' **' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityIntermediate" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Evaluation', ['1' => __('Advanced')]) . ' ***' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="abilityAdvanced" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Proyek Aplikasi --}}
    <flux:callout variant="secondary" class="space-y-6">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Application Project') }}</flux:label>
                <x-textarea-wysiwyg wire:model="project" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Refreleksi --}}
    <flux:callout variant="secondary" class="space-y-6">
        <flux:heading class="mb-6">
            {{ __('Lesson Reflection') }}
        </flux:heading>
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Reflection', ['1' => __('Basic')]) . ' *' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="reflectionBasic" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Reflection', ['1' => __('Intermediate')]) . ' **' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="reflectionIntermediate" />
            </flux:field>
            <flux:field>
                <flux:label :badge="__('Required')">
                    {{ __(':1 Reflection', ['1' => __('Advanced')]) . ' ***' }}
                </flux:label>
                <x-textarea-wysiwyg wire:model="reflectionAdvanced" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Kunci Jawaban --}}
    <flux:callout variant="secondary" class="space-y-6">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Answer Key') }}</flux:label>
                <x-textarea-wysiwyg wire:model="answerKey" />
            </flux:field>
        </div>
    </flux:callout>

    {{-- Rubrik Penilaian --}}
    <flux:callout variant="secondary" class="space-y-6">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label :badge="__('Required')">{{ __('Assesment Section') }}</flux:label>
                <x-textarea-wysiwyg wire:model="assessmentSection" />
            </flux:field>
        </div>
    </flux:callout>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" icon="save" wire:click="store" wire:loading.attr="disabled"
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
</div>
