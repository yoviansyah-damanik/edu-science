<div class="space-y-6">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate>
            {{ __('Home') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ $year }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            {{ __(Str::title($semester)) }}
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="" data-area="page-title">
        <flux:heading size="xl" level="1">
            {{ __('Lesson Plans') }}
        </flux:heading>
        <flux:text>
            {{ __('Display all lesson plans added by users.') }}
        </flux:text>
    </div>

    <div class="" data-area="filter">
        <div class="flex gap-4 flex-col lg:flex-row">
            <flux:input.group>
                <flux:input wire:model.live.debounce.500ms="search"
                    :placeholder="__('Search by :1', ['1' => Str::lower(__('Title'))])" clearable />
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
                    <th>{{ __("Author's Name") }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Phase') }}</th>
                    <th>{{ __('Time Allocation') }}</th>
                    <th>{{ __('Subject') }}</th>
                    <th>{{ __('Class') }}</th>
                    <th>{{ __('Semester') . '/' . __('Year') }}</th>
                    <th>{{ __('Lesson Model') }}</th>
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
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <flux:link class="font-semibold" :href="route('index', $item)" wire:navigate>
                                {{ $item->title }}
                            </flux:link>
                        </td>
                        <td>{{ $item->phase }}</td>
                        <td>{{ $item->time_allocation }}</td>
                        <td>{{ $item->subject . '/' . $item->subject_element }}</td>
                        <td>{{ $item->class }}</td>
                        <td>{{ __(Str::title($item->semester)) . '/' . $item->year }}</td>
                        <td>{{ $item->teachingModule?->lesson_model }}</td>
                        <td class="text-end">
                            <flux:dropdown position="left">
                                <flux:button variant="ghost" icon:trailing="ellipsis"></flux:button>
                                <flux:menu>
                                    <flux:menu.item :href="route('index', $item)" wire:navigate icon="eye">
                                        {{ __('Show More') }}</flux:menu.item>
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
</div>
