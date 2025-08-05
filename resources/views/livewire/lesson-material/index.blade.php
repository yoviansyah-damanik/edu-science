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
        <flux:breadcrumbs.item>{{ __('Lesson Materials') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="" data-area="page-title">
        <flux:heading size="xl" level="1">
            {{ __('Lesson Materials') }}
        </flux:heading>
        <flux:text>
            {{ __('Manage your lesson materials.') }}
        </flux:text>
    </div>

    <div class="" data-area="filter">
        <div class="flex gap-4 flex-col lg:flex-row">
            <flux:button variant="primary" :href="route('lesson-materials.create', $lessonPlan)" icon="plus"
                wire:navigate>
                {{ __('Add :1', ['1' => __('Lesson Material')]) }}
            </flux:button>
            <flux:input.group>
                <flux:input wire:model.live.debounce.500ms="search"
                    :placeholder="__('Search by :1', ['1' => Str::lower(__('Title'))])" clearable />
                <flux:select class="max-w-fit" wire:model.live.debounce.500ms="lessonMaterialCategory">
                    <flux:select.option value="all">
                        {{ __('All') }}
                    </flux:select.option>
                    @foreach ($lessonMaterialCategories as $lessonMaterialCategory)
                        <flux:select.option :value="$lessonMaterialCategory->id">
                            {{ $lessonMaterialCategory->name }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:button variant="primary" color="red" class="px-3" wire:click="refresh" icon="rotate-ccw">
                </flux:button>
            </flux:input.group>
        </div>
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
                    <th>{{ __('Summary') }}</th>
                    <th>{{ __('Video') }}</th>
                    <th>{{ __('Attachment') }}</th>
                    <th>{{ __('Lesson Activity') }}</th>
                    <th>{{ __('Student Worksheet') }}</th>
                    <th>{{ __('Assessment') }}</th>
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
                            <flux:link class="font-semibold"
                                :href="route('lesson-materials.show', ['lessonPlan' => $lessonPlan, 'lessonMaterial' =>
                                    $item
                                ])"
                                wire:navigate>
                                {{ $item->title }}
                            </flux:link>

                            <div class="flex flex-col gap-1 mt-4">
                                <div class="flex gap-1 items-center">
                                    <flux:icon.user class="size-4" />
                                    {{ $item->user->name }}
                                </div>
                                <flux:link class="!flex gap-1 items-center cursor-pointer"
                                    wire:click="$set('lessonMaterialCategory',{{ $item->category->id }})">
                                    <flux:icon.shapes class="size-4" />
                                    {{ $item->category->name }}
                                </flux:link>
                                <div class="flex gap-1 items-center">
                                    <flux:icon.clock class="size-4" />
                                    {{ $item->created_at->format('d/m/Y H:i:s') }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="font-light">
                                {{ $item->summary }}
                            </p>
                        </td>
                        <td>
                            @if ($item->youtube_url)
                                <flux:button :href="$item->youtube_url" target="_blank"
                                    class="h-8 aspect-square rounded-xl bg-red-400 grid place-items-center">
                                    <flux:icon.youtube variant="mini" />
                                </flux:button>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($item->files->count() > 0)
                                <livewire:attachment.index :items="$item->files" :name="'lessonMaterialAttachments-' . $item->id"
                                    wire:key="lessonMaterialAttachments-{{ $item->id }}" />
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="flex flex-col gap-2 max-w-32">
                                @if ($item->activity)
                                    <flux:button variant="primary" color="blue" icon="eye" size="xs"
                                        :href="route('lesson-activities.show', ['lessonPlan' => $lessonPlan, 'lessonActivity' => $item->activity])"
                                        wire:navigate>
                                        {{ __('Show') }}
                                    </flux:button>
                                    <flux:button variant="primary" color="yellow" icon="pencil-line" size="xs"
                                        :href="route('lesson-activities.edit', ['lessonPlan' => $lessonPlan, 'lessonActivity' =>$item->activity])"
                                        wire:navigate>
                                        {{ __('Edit') }}
                                    </flux:button>
                                    <flux:button variant="danger" icon="trash" size="xs"
                                        wire:click="$dispatch('setDeleteLessonActivity',{ lessonActivity: {{ $item->activity }}, isRefresh: false})">
                                        {{ __('Delete') }}
                                    </flux:button>
                                @else
                                    <flux:button icon="plus" size="xs"
                                        :href="route('lesson-activities.create', ['lessonPlan' => $lessonPlan,
                                            'lessonMaterial' => $item
                                        ])"
                                        wire:navigate>
                                        {{ __('Add') }}
                                    </flux:button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-2 max-w-32">
                                @if ($item->worksheet)
                                    <flux:button variant="primary" color="blue" icon="eye" size="xs"
                                        :href="route('student-worksheet.show', ['lessonPlan' => $lessonPlan, 'studentWorksheet' =>$item->worksheet])"
                                        wire:navigate>
                                        {{ __('Show') }}
                                    </flux:button>
                                    <flux:button variant="primary" color="yellow" icon="pencil-line" size="xs"
                                        :href="route('student-worksheet.edit', ['lessonPlan' => $lessonPlan, 'studentWorksheet' =>$item->worksheet])"
                                        wire:navigate>
                                        {{ __('Edit') }}
                                    </flux:button>
                                    <flux:button variant="danger" icon="trash" size="xs"
                                        wire:click="$dispatch('setDeleteStudentWorksheet',{ studentWorksheet: {{ $item->worksheet }}, isRefresh: false})">
                                        {{ __('Delete') }}
                                    </flux:button>
                                @else
                                    <flux:button icon="plus" size="xs"
                                        :href="route('student-worksheet.create', ['lessonPlan' => $lessonPlan,
                                            'lessonMaterial' =>
                                            $item
                                        ])"
                                        wire:navigate>
                                        {{ __('Add') }}
                                    </flux:button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-2 max-w-32">
                                @if ($item->assessment)
                                    <flux:button variant="primary" color="blue" icon="eye" size="xs"
                                        :href="route('lesson-assessments.show', ['lessonPlan' => $lessonPlan, 'lessonAssessment' =>$item->assessment])"
                                        wire:navigate>
                                        {{ __('Show') }}
                                    </flux:button>
                                    <flux:button variant="primary" color="yellow" icon="pencil-line" size="xs"
                                        :href="route('lesson-assessments.edit', ['lessonPlan' => $lessonPlan, 'lessonAssessment' =>$item->assessment])"
                                        wire:navigate>
                                        {{ __('Edit') }}
                                    </flux:button>
                                    <flux:button variant="danger" icon="trash" size="xs"
                                        wire:click="$dispatch('setDeleteLessonAssessment',{ lessonAssessment: {{ $item->assessment }}, isRefresh: false})">
                                        {{ __('Delete') }}
                                    </flux:button>
                                @else
                                    <flux:button icon="plus" size="xs"
                                        :href="route('lesson-assessments.create', ['lessonPlan' => $lessonPlan,
                                            'lessonMaterial' =>
                                            $item
                                        ])"
                                        wire:navigate>
                                        {{ __('Add') }}
                                    </flux:button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <flux:select wire:change="setOrder({{ $item->id }},$event.target.value)">
                                @foreach (range(1, max($items->max('order'), $items->count())) as $x)
                                    <flux:select.option :value="$x" :selected="$x == $item->order">
                                        {{ $x }}
                                    </flux:select.option>
                                @endforeach
                            </flux:select>
                        </td>
                        <td class="text-end">
                            <flux:dropdown position="left">
                                <flux:button variant="ghost" icon:trailing="ellipsis"></flux:button>
                                <flux:menu>
                                    <flux:menu.item
                                        :href="route('lesson-materials.show', ['lessonPlan' => $lessonPlan, 'lessonMaterial' =>
                                            $item
                                        ])"
                                        wire:navigate icon="eye">{{ __('Show') }}</flux:menu.item>
                                    <flux:menu.item
                                        :href="route('lesson-materials.edit', ['lessonPlan' => $lessonPlan, 'lessonMaterial' =>
                                            $item
                                        ])"
                                        wire:navigate icon="pencil-line">{{ __('Edit') }}</flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item variant="danger" icon="trash"
                                        wire:click="$dispatch('setDeleteLessonMaterial',{ lessonMaterial: '{{ $item->slug }}', isRefresh: false })">
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
        <flux:modal name="show-attachment-modal" class="w-full max-w-6xl">
            <livewire:attachment.show lazy />
        </flux:modal>
        <flux:modal name="delete-lesson-material-modal" class="w-full max-w-xl">
            <livewire:lesson-material.delete lazy />
        </flux:modal>
        <flux:modal name="delete-student-worksheet-modal" class="w-full max-w-xl">
            <livewire:student-worksheet.delete lazy />
        </flux:modal>
        <flux:modal name="delete-lesson-activity-modal" class="w-full max-w-xl">
            <livewire:lesson-activity.delete lazy />
        </flux:modal>
        <flux:modal name="delete-lesson-assessment-modal" class="w-full max-w-xl">
            <livewire:lesson-assessment.delete lazy />
        </flux:modal>
    </div>
</div>
