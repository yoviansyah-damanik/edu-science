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
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('index',$lessonPlan->id)" wire:navigate>
            {{ __('Lesson Plans') }}:
            {{ $lessonPlan->title }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Evaluation') }} </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Show') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <livewire:lesson-plan.identify :$lessonPlan withPrintButton withLetterhead :title="__('Teacher Competency Survey Instrument')" />

    {{-- Score --}}
    <livewire:evaluation.score :evaluation="$lessonPlan->evaluation" />

    {{-- Kelompok A --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN A: KOMPETENSI PEDAGOGIK
        </flux:callout.heading>
        <div class="w-full overflow-x-auto" data-area="table">
            <table
                class="w-full table-auto md:table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
                <thead
                    class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                    <tr
                        class="[&>*]:py-3 [&>*]:text-center [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                        <th class="w-12">{{ '#' }}</th>
                        <th>{{ __('Question') }}</th>
                        <th class="w-64">
                            {{ __('Your choice') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                    [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                    @foreach ($questions->where('group', 'A') as $question)
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                            <td class="text-center">
                                A.{{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $question->question }}
                            </td>
                            <td class="text-center">
                                <flux:radio.group disabled variant="segmented" size="sm">
                                    <flux:radio label="1"
                                        :checked="$grouped->where('group','A')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 1" />
                                    <flux:radio label="2"
                                        :checked="$grouped->where('group','A')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 2" />
                                    <flux:radio label="3"
                                        :checked="$grouped->where('group','A')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 3" />
                                    <flux:radio label="4"
                                        :checked="$grouped->where('group','A')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 4" />
                                    <flux:radio label="5"
                                        :checked="$grouped->where('group','A')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 5" />
                                </flux:radio.group>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </flux:callout>

    {{-- Kelompok B --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN B: KOMPETENSI KEPRIBADIAN
        </flux:callout.heading>
        <div class="w-full overflow-x-auto" data-area="table">
            <table
                class="w-full table-auto md:table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
                <thead
                    class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                    <tr
                        class="[&>*]:py-3 [&>*]:text-center [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                        <th class="w-12">{{ '#' }}</th>
                        <th>{{ __('Question') }}</th>
                        <th class="w-64">
                            {{ __('Your choice') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                    [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                    @foreach ($questions->where('group', 'B') as $question)
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                            <td class="text-center">
                                B.{{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $question->question }}
                            </td>
                            <td class="text-center">
                                <flux:radio.group disabled variant="segmented" size="sm">
                                    <flux:radio label="1"
                                        :checked="$grouped->where('group','B')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 1" />
                                    <flux:radio label="2"
                                        :checked="$grouped->where('group','B')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 2" />
                                    <flux:radio label="3"
                                        :checked="$grouped->where('group','B')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 3" />
                                    <flux:radio label="4"
                                        :checked="$grouped->where('group','B')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 4" />
                                    <flux:radio label="5"
                                        :checked="$grouped->where('group','B')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 5" />
                                </flux:radio.group>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </flux:callout>

    {{-- Kelompok C --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN C: KOMPETENSI SOSIAL
        </flux:callout.heading>
        <div class="w-full overflow-x-auto" data-area="table">
            <table
                class="w-full table-auto md:table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
                <thead
                    class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                    <tr
                        class="[&>*]:py-3 [&>*]:text-center [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                        <th class="w-12">{{ '#' }}</th>
                        <th>{{ __('Question') }}</th>
                        <th class="w-64">
                            {{ __('Your choice') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                    [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                    @foreach ($questions->where('group', 'C') as $question)
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                            <td class="text-center">
                                C.{{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $question->question }}
                            </td>
                            <td class="text-center">
                                <flux:radio.group disabled variant="segmented" size="sm">
                                    <flux:radio label="1"
                                        :checked="$grouped->where('group','C')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 1" />
                                    <flux:radio label="2"
                                        :checked="$grouped->where('group','C')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 2" />
                                    <flux:radio label="3"
                                        :checked="$grouped->where('group','C')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 3" />
                                    <flux:radio label="4"
                                        :checked="$grouped->where('group','C')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 4" />
                                    <flux:radio label="5"
                                        :checked="$grouped->where('group','C')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 5" />
                                </flux:radio.group>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </flux:callout>

    {{-- Kelompok D --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN D: KOMPETENSI PROFESIONAL
        </flux:callout.heading>

        <div class="w-full overflow-x-auto" data-area="table">
            <table
                class="w-full table-auto md:table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
                <thead
                    class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                    <tr
                        class="[&>*]:py-3 [&>*]:text-center [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                        <th class="w-12">{{ '#' }}</th>
                        <th>{{ __('Question') }}</th>
                        <th class="w-64">
                            {{ __('Your choice') }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                    [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                    @foreach ($questions->where('group', 'D') as $question)
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                            <td class="text-center">
                                D.{{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $question->question }}
                            </td>
                            <td class="text-center">
                                <flux:radio.group disabled variant="segmented" size="sm">
                                    <flux:radio label="1"
                                        :checked="$grouped->where('group','D')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 1" />
                                    <flux:radio label="2"
                                        :checked="$grouped->where('group','D')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 2" />
                                    <flux:radio label="3"
                                        :checked="$grouped->where('group','D')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 3" />
                                    <flux:radio label="4"
                                        :checked="$grouped->where('group','D')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 4" />
                                    <flux:radio label="5"
                                        :checked="$grouped->where('group','D')->first()['answers']->where('question_id',$question->id)->first()['answer'] == 5" />
                                </flux:radio.group>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </flux:callout>

    {{-- Refleksi --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN E: REFLEKSI DIRI
        </flux:callout.heading>

        <flux:callout.text>
            <div class="space-y-6">
                <flux:field>
                    <flux:heading>
                        REF-1. {{ $questions->where('group', 'REF-1')->first()->question }}
                    </flux:heading>
                    <flux:radio.group disabled variant="segmented" size="sm">
                        <flux:radio label="Pedagogik"
                            :checked="$grouped->where('group','REF-1')->first()['answers']->first()['answer'] == 'Pedagogik'" />
                        <flux:radio label="Kepribadian"
                            :checked="$grouped->where('group','REF-1')->first()['answers']->first()['answer'] == 'Kepribadian'" />
                        <flux:radio label="Sosial"
                            :checked="$grouped->where('group','REF-1')->first()['answers']->first()['answer'] == 'Sosial'" />
                        <flux:radio label="Profesional"
                            :checked="$grouped->where('group','REF-1')->first()['answers']->first()['answer'] == 'Profesional'" />
                    </flux:radio.group>
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-2. {{ $questions->where('group', 'REF-2')->first()->question }}
                    </flux:heading>
                    <flux:text>
                        {{ $grouped->where('group', 'REF-2')->first()['answers']->first()['answer'] }}
                    </flux:text>
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-3. {{ $questions->where('group', 'REF-3')->first()->question }}
                    </flux:heading>
                    <flux:text>
                        {{ $grouped->where('group', 'REF-3')->first()['answers']->first()['answer'] }}
                    </flux:text>
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-4. {{ $questions->where('group', 'REF-4')->first()->question }}
                    </flux:heading>
                    <flux:text>
                        {{ $grouped->where('group', 'REF-4')->first()['answers']->first()['answer'] }}
                    </flux:text>
                </flux:field>
            </div>
        </flux:callout.text>
    </flux:callout>
</div>
