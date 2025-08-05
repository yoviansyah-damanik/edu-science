<div class="space-y-6">
    {{-- Capaian --}}
    <div class="text-lg md:text-2xl font-bold text-center uppercase">
        @if ($interpretationOfValue >= 4.21 && $interpretationOfValue <= 5.0)
            <flux:callout color="green">
                {{ __('Highly Competent') . " ({$interpretationOfValue})" }}
            </flux:callout>
        @elseif($interpretationOfValue >= 3.41 && $interpretationOfValue <= 4.2)
            <flux:callout color="emerald">
                {{ __('Competent') . " ({$interpretationOfValue})" }}
            </flux:callout>
        @elseif($interpretationOfValue >= 2.61 && $interpretationOfValue <= 3.4)
            <flux:callout color="yellow">
                {{ __('Sufficiently Competent') . " ({$interpretationOfValue})" }}
            </flux:callout>
        @elseif($interpretationOfValue >= 1.81 && $interpretationOfValue <= 2.6)
            <flux:callout color="rose">
                {{ __('Less Competent') . " ({$interpretationOfValue})" }}
            </flux:callout>
        @else
            <flux:callout color="red">
                {{ __('Highly Less Competent') . " ({$interpretationOfValue})" }}
            </flux:callout>
        @endif
    </div>

    {{-- Tabel Skor --}}
    <flux:callout color="secondary" icon="file-check-2">
        <flux:callout.heading>
            {{ __('Score Recap') }}
        </flux:callout.heading>

        <flux:callout.text>
            <div class="w-full block overflow-x-hidden">
                <table
                    class="w-full table-auto md:table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
                    <thead
                        class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                        <tr
                            class="[&>*]:py-3 [&>*]:text-center [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                            <th class="w-12">{{ '#' }}</th>
                            <th>{{ __('Competency') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Score') }}</th>
                            <th>{{ __('Maximum Score') }}</th>
                            <th>{{ __('Percentage') . ' (%)' }}</th>
                        </tr>
                    </thead>
                    <tbody
                        class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                    [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0">
                            <td class="text-center">1</td>
                            <td>Pedagogik</td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'A')->first()['category'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'A')->first()['total_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'A')->first()['max_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'A')->first()['percentage'] }}
                            </td>
                        </tr>
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0">
                            <td class="text-center">2</td>
                            <td>Kepribadian</td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'B')->first()['category'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'B')->first()['total_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'B')->first()['max_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'B')->first()['percentage'] }}
                        </tr>
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0">
                            <td class="text-center">3</td>
                            <td>Sosial</td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'C')->first()['category'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'C')->first()['total_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'C')->first()['max_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'C')->first()['percentage'] }}
                        </tr>
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0">
                            <td class="text-center">4</td>
                            <td>Profesional</td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'D')->first()['category'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'D')->first()['total_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'D')->first()['max_score'] }}
                            </td>
                            <td class="text-center">{{ $scoresPerGroup->where('group', 'D')->first()['percentage'] }}
                        </tr>
                        <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0">
                            <th class="text-center" colspan=3>
                                {{ __('Total') }}
                            </th>
                            <th class="text-center">
                                {{ $scoresPerGroup->where('group', 'Total')->first()['total_score'] }}
                            </th>
                            <th class="text-center">
                                {{ $scoresPerGroup->where('group', 'Total')->first()['max_score'] }}
                            </th>
                            <th class="text-center">
                                {{ $scoresPerGroup->where('group', 'Total')->first()['percentage'] }}
                        </tr>
                    </tbody>
                </table>
            </div>
        </flux:callout.text>
    </flux:callout>

    {{-- Informasi Skor --}}
    <flux:callout color="sky" icon="file-check-2">
        <flux:callout.heading>
            {{ __('Interpretation of Values') }}
        </flux:callout.heading>
        <flux:callout.text>
            <ol class="list-decimal">
                <li>Sangat Kompeten: 81% - 100% (Skor 4,21 - 5,00)</li>
                <li>Kompeten: 61% - 80% (Skor 3,41 - 4,20)</li>
                <li>Cukup Kompeten: 41% - 60% (Skor 2,61 - 3,40)</li>
                <li>Kurang Kompeten: 21% - 40% (Skor 1,81 - 2,60)</li>
                <li>Sangat Kurang Kompeten: 0% - 20% (Skor 1,00 - 1,80)</li>
            </ol>
        </flux:callout.text>
    </flux:callout>
</div>
