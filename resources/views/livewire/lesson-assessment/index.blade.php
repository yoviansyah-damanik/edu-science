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
        <flux:breadcrumbs.item>{{ __('Assessments') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="" data-area="page-title">
        <flux:heading size="xl" level="1">
            {{ __('Assessments') }}
        </flux:heading>
        <flux:text>
            {{ __('Manage your lesson assessments.') . ' ' . __('You can add lesson assessments to the lesson material menu.') }}
            <flux:link :href="route('lesson-materials.index', $lessonPlan)" wire:navigate>{{ __('Click here') }}
            </flux:link>
        </flux:text>
    </div>

    <div class="w-full overflow-x-auto" data-area="table">
        <table
            class="text-sm [:where(&)]:min-w-full table-fixed text-zinc-800 divide-y divide-zinc-800/10 dark:divide-white/20 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal">
            <thead
                class="border-b border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]">
                <tr
                    class="[&>*]:py-3 [&>*]:text-start [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-zinc-800 [&>*]:dark:text-white">
                    <th>{{ '#' }}</th>
                    <th>{{ __('Lesson Material') }}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody
                class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                @forelse ($items as $item)
                    <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                        <td>
                            {{ $items->perPage() * ($items->currentPage() - 1) + $loop->iteration }}
                        </td>
                        <td>
                            <div class="font-semibold mb-4">
                                {{ __('SW Lesson :1', ['1' => $item->material->order]) }}
                            </div>
                            <flux:link
                                :href="route('lesson-assessments.show', ['lessonPlan' => $lessonPlan, 'lessonAssessment' =>
                                    $item
                                ])"
                                wire:navigate>
                                {{ $item->material->title }}
                            </flux:link>
                        </td>
                        <td>
                            <div class="flex flex-col gap-1">
                                <div class="flex gap-1 items-center">
                                    <flux:icon.user class="size-4" />
                                    {{ $item->material->user->name }}
                                </div>
                                <div class="flex gap-1 items-center">
                                    <flux:icon.clock class="size-4" />
                                    {{ $item->created_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <flux:dropdown position="left">
                                <flux:button variant="ghost" icon:trailing="ellipsis"></flux:button>
                                <flux:menu>
                                    <flux:menu.item
                                        :href="route('lesson-assessments.show', ['lessonPlan' => $lessonPlan,
                                            'lessonAssessment' => $item
                                        ])"
                                        wire:navigate icon="eye">{{ __('Show') }}</flux:menu.item>
                                    <flux:menu.item
                                        :href="route('lesson-assessments.edit', ['lessonPlan' => $lessonPlan,
                                            'lessonAssessment' => $item
                                        ])"
                                        wire:navigate icon="pencil-line">{{ __('Edit') }}</flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item variant="danger" icon="trash"
                                        wire:click="$dispatch('setDeleteLessonAssessment',{ lessonAssessment: '{{ $item->id }}', isRefresh: false })">
                                        {{ __('Delete') }}
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="py-3 px-4 text-center">
                            <flux:text>
                                {{ __('No data displayed') }}
                            </flux:text>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="" data-area="pagination">
        {{ $items->links() }}
    </div>

    <div>
        <flux:modal name="delete-lesson-assessment-modal" class="w-full max-w-xl">
            <livewire:lesson-assessment.delete lazy />
        </flux:modal>
    </div>
</div>
