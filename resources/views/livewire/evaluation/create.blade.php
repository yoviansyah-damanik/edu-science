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
                </flux:navmenu>
            </flux:dropdown>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('index',$lessonPlan->id)" wire:navigate>
            {{ __('Lesson Plans') }}:
            {{ $lessonPlan->title }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Evaluation') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:callout variant="warning" icon="exclamation-circle">
        <flux:callout.heading>
            {{ __('Filling Instructions') }}
        </flux:callout.heading>
        <flux:callout.text>
            <ol class="list-decimal ps-4">
                <li>Bacalah setiap pernyataan dengan cermat</li>
                <li>Berilah tanda dot (⊙) pada kolom yang sesuai dengan kondisi Anda</li>
                <li>Pilihlah jawaban yang paling sesuai dengan kenyataan, bukan yang diharapkan</li>
                <li>Tidak ada jawaban yang salah atau benar, semua bergantung pada kondisi nyata</li>
                <li>Isilah semua pernyataan, jangan ada yang terlewat</li>
            </ol>
        </flux:callout.text>
    </flux:callout>

    <flux:callout color="sky" icon="file-check-2">
        <flux:callout.heading>
            {{ __('Assessment Scale') }}
        </flux:callout.heading>
        <flux:callout.text>
            <ol>
                <li>5 = Sangat Baik/Selalu: Saya melakukan hal ini dengan sangat baik/selalu</li>
                <li>4 = Baik/Sering: Saya melakukan hal ini dengan baik/sering</li>
                <li>3 = Cukup/Kadang-kadang: Saya melakukan hal ini dengan cukup/kadang-kadang</li>
                <li>2 = Kurang/Jarang: Saya melakukan hal ini dengan kurang/jarang</li>
                <li>1 = Sangat Kurang/Tidak Pernah: Saya melakukan hal ini dengan sangat kurang/tidak pernah</li>
            </ol>
        </flux:callout.text>
    </flux:callout>

    {{-- Kelompok A --}}
    <flux:callout variant="secondary">
        <flux:callout.heading>
            BAGIAN A: KOMPETENSI PEDAGOGIK
        </flux:callout.heading>
        <div class="w-full overflow-x-auto" data-area="table">
            <table
                class="w-full table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
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
                                <flux:radio.group wire:model="answers.{{ $question->id }}" variant="segmented"
                                    size="sm">
                                    <flux:radio value="{{ $question->id }}/1/{{ $question->group }}" label="1" />
                                    <flux:radio value="{{ $question->id }}/2/{{ $question->group }}" label="2" />
                                    <flux:radio value="{{ $question->id }}/3/{{ $question->group }}" label="3" />
                                    <flux:radio value="{{ $question->id }}/4/{{ $question->group }}" label="4" />
                                    <flux:radio value="{{ $question->id }}/5/{{ $question->group }}" label="5" />
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
                class="w-full table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
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
                                <flux:radio.group wire:model="answers.{{ $question->id }}" variant="segmented"
                                    size="sm">
                                    <flux:radio value="{{ $question->id }}/1/{{ $question->group }}" label="1" />
                                    <flux:radio value="{{ $question->id }}/2/{{ $question->group }}" label="2" />
                                    <flux:radio value="{{ $question->id }}/3/{{ $question->group }}" label="3" />
                                    <flux:radio value="{{ $question->id }}/4/{{ $question->group }}" label="4" />
                                    <flux:radio value="{{ $question->id }}/5/{{ $question->group }}" label="5" />
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
                class="w-full table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
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
                                <flux:radio.group wire:model="answers.{{ $question->id }}" variant="segmented"
                                    size="sm">
                                    <flux:radio value="{{ $question->id }}/1/{{ $question->group }}" label="1" />
                                    <flux:radio value="{{ $question->id }}/2/{{ $question->group }}" label="2" />
                                    <flux:radio value="{{ $question->id }}/3/{{ $question->group }}" label="3" />
                                    <flux:radio value="{{ $question->id }}/4/{{ $question->group }}" label="4" />
                                    <flux:radio value="{{ $question->id }}/5/{{ $question->group }}" label="5" />
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
                class="w-full table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
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
                                <flux:radio.group wire:model="answers.{{ $question->id }}" variant="segmented"
                                    size="sm">
                                    <flux:radio value="{{ $question->id }}/1/{{ $question->group }}"
                                        label="1" />
                                    <flux:radio value="{{ $question->id }}/2/{{ $question->group }}"
                                        label="2" />
                                    <flux:radio value="{{ $question->id }}/3/{{ $question->group }}"
                                        label="3" />
                                    <flux:radio value="{{ $question->id }}/4/{{ $question->group }}"
                                        label="4" />
                                    <flux:radio value="{{ $question->id }}/5/{{ $question->group }}"
                                        label="5" />
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
                    <flux:radio.group wire:model="ref1" variant="segmented" size="sm">
                        <flux:radio value="Pedagogik" label="Pedagogik" />
                        <flux:radio value="Kepribadian" label="Kepribadian" />
                        <flux:radio value="Sosial" label="Sosial" />
                        <flux:radio value="Profesional" label="Profesional" />
                    </flux:radio.group>
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-2. {{ $questions->where('group', 'REF-2')->first()->question }}
                    </flux:heading>
                    <flux:textarea wire:model="ref2" />
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-3. {{ $questions->where('group', 'REF-3')->first()->question }}
                    </flux:heading>
                    <flux:textarea wire:model="ref3" />
                </flux:field>
                <flux:field>
                    <flux:heading>
                        REF-4. {{ $questions->where('group', 'REF-4')->first()->question }}
                    </flux:heading>
                    <flux:textarea wire:model="ref4" />
                </flux:field>
            </div>
        </flux:callout.text>
    </flux:callout>

    <flux:button wire:click="store" icon="save">{{ __('Save') }}</flux:button>
</div>
