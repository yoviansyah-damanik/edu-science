<div class="space-y-6">
    @if (!$showOnly)
        <livewire:lesson-plan.identify withPrintButton :$lessonPlan :withLetterhead="false" :title="__('Student Worksheet') . ' #' . $studentWorksheet->material->order" />

        <flux:callout variant="secondary">
            <flux:callout.text class="space-y-4">
                <div class="flex">
                    <div class="w-48 font-semibold">
                        {{ __('Class') . '/' . __('Semester') }}
                    </div>
                    <div class="flex-1">
                        : {{ $lessonPlan->class . '/' . __(Str::title($lessonPlan->semester)) }}
                    </div>
                </div>
                <div class="flex">
                    <div class="w-48 font-semibold">
                        {{ __('Subject') }}
                    </div>
                    <div class="flex-1">
                        : {{ $lessonPlan->subject . '/' . $lessonPlan->subject_element }}
                    </div>
                </div>
                <div class="flex">
                    <div class="w-48 font-semibold">
                        {{ __('Day/Date') }}
                    </div>
                    <div class="flex-1">
                        : __________________________________________________________
                    </div>
                </div>
                <div class="flex">
                    <div class="w-48 font-semibold">
                        {{ __('Student Name') }}
                    </div>
                    <div class="flex-1">
                        : __________________________________________________________
                    </div>
                </div>
            </flux:callout.text>
        </flux:callout>
    @endif

    <div class="gap-3 [&>*:not(:last-child)]:me-3 text-sm [&>*]:inline-flex [&>*]:gap-1 [&>*]:items-center">
        <div>
            <flux:icon.clock class="size-4" />
            {{ $studentWorksheet->created_at->format('d/m/Y H:i:s') }}
        </div>
        @if (!$showOnly)
            @if ($lessonPlan->user_id == auth()->id())
                <flux:link wire:navigate
                    :href="route('student-worksheet.edit', ['lessonPlan' => $lessonPlan, 'studentWorksheet' =>
                        $studentWorksheet
                    ])"
                    data-no-print>
                    <flux:icon.pencil-line class="size-4" />
                    {{ __('Edit') }}
                </flux:link>
                <flux:link class="cursor-pointer"
                    wire:click="$dispatch('setDeleteStudentWorksheet',{ studentWorksheet: '{{ $studentWorksheet->id }}', isRefresh:true})"
                    data-no-print>
                    <flux:icon.trash class="size-4" />
                    {{ __('Delete') }}
                </flux:link>
            @endif
        @else
            <flux:link wire:navigate
                :href="route('student-worksheet.show', ['lessonPlan' => $lessonPlan, 'studentWorksheet' => $studentWorksheet])"
                data-no-print>
                <flux:icon.eye class="size-4" />
                {{ __('Show More') }}
            </flux:link>
        @endif
    </div>

    {{-- Kompetensi Dasar --}}
    <flux:callout variant="secondary">
        <flux:callout.text class="space-y-4">
            <div class="flex">
                <div class="w-48 font-semibold">
                    {{ __('Lesson Material') }}
                </div>
                <div class="flex-1">
                    : {{ $studentWorksheet->material->title }}
                </div>
            </div>
            <div class="flex">
                <div class="w-48 font-semibold">
                    {{ __('Basic Competency') }}
                </div>
                <div class="flex-1">
                    : {{ $studentWorksheet->basic_competency }}
                </div>
            </div>
            <div class="flex">
                <div class="w-48 font-semibold">
                    {{ __('Objective') }}
                </div>
                <div class="flex-1">
                    : {{ $studentWorksheet->objective }}
                </div>
            </div>
        </flux:callout.text>
    </flux:callout>

    <flux:callout variant="secondary">
        <flux:callout.heading class="mb-4">
            {{ __('Basic Skill') }}
        </flux:callout.heading>
        <flux:callout.text>
            {!! $studentWorksheet->basic_skill !!}
        </flux:callout.text>
    </flux:callout>

    @if (!$showOnly)
        {{-- Diferensiasi Berdasarkan Tingkat Kemampuan --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Differentiation Based on Ability Level') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Level', ['1' => __('Basic')]) . ' (' . __('For students who need more help') . ')' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->ability_basic !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Level', ['1' => __('Intermediate')]) . ' (' . __('For students with average abilities') . ')' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->ability_intermediate !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Level', ['1' => __('Advanced')]) . ' (' . __('For students with high abilities') . ')' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->ability_advanced !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Diferensiasi Berdasarkan Gaya Belajar --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Differentiation Based on Learning Styles') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Visual Learners') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->style_visual !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Audio Learners') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->style_audio !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Kinesthetic Learners') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->style_kinesthetic !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Diferensiasi Berdasarkan Minat --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Differentiation Based on Interest') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Students Who Like Engineering/Construction') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->interest_technique !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Students Who Like Adventure') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->interest_adventure !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('For Students Who Like Home Economics') }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->interest_household !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Soal Tantangan Bertingkat --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Tiered Challenge Questions') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('Level :1 Challenge', ['1' => 1]) . ' *' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->question_lv_1 !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('Level :1 Challenge', ['1' => 2]) . ' **' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->question_lv_2 !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __('Level :1 Challenge', ['1' => 3]) . ' ***' }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->question_lv_3 !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Evaluasi Pemahaman --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Comprehension Evaluation') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Evaluation', ['1' => __('Basic')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->evaluation_basic !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Evaluation', ['1' => __('Intermediate')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->evaluation_intermediate !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Evaluation', ['1' => __('Advanced')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->evaluation_advanced !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Refleksi Pembelajaran --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Application Project') }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $studentWorksheet->project !!}
            </flux:callout.text>
        </flux:callout>

        {{-- Refleksi Pembelajaran --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Lesson Reflection') }}
            </flux:callout.heading>

            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Reflection', ['1' => __('Basic')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->reflection_basic !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Reflection', ['1' => __('Intermediate')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->reflection_intermediate !!}
                </flux:callout.text>
            </flux:callout>
            <flux:callout variant="secondary">
                <flux:callout.heading class="mb-4">
                    {{ __(':1 Reflection', ['1' => __('Advanced')]) }}
                </flux:callout.heading>
                <flux:callout.text>
                    {!! $studentWorksheet->reflection_advanced !!}
                </flux:callout.text>
            </flux:callout>
        </flux:callout>

        {{-- Kunci Jawaban --}}
        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Answer Key') }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $studentWorksheet->answer_key !!}
            </flux:callout.text>
        </flux:callout>

        <flux:callout variant="secondary">
            <flux:callout.heading class="mb-4">
                {{ __('Assesment Section') }}
            </flux:callout.heading>
            <flux:callout.text>
                {!! $studentWorksheet->assessment_section !!}
            </flux:callout.text>
        </flux:callout>
    @endif
</div>
