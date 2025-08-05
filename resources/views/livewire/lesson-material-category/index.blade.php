<div class="space-y-6">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('home')" icon="home" wire:navigate>
            {{ __('Home') }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Lesson Material Category') }} </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="" data-area="page-title">
        <flux:heading size="xl" level="1">
            {{ __('Lesson Material Category') }}
        </flux:heading>
        <flux:text>
            {{ __('Manage your lesson material category.') }}
        </flux:text>
    </div>

    <div class="" data-area="filter">
        <div class="flex gap-4 flex-col lg:flex-row">
            <flux:button variant="primary" icon="plus" wire:click="$dispatch('setCreateCategory')">
                {{ __('Add :1', ['1' => __('Lesson Material Category')]) }}
            </flux:button>
            <flux:input.group>
                <flux:input wire:model.live.debounce.500ms="search"
                    :placeholder="__('Search by :1', ['1' => Str::lower(__('Name'))])" clearable />
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
                    <th>{{ __('Name of :1', ['1' => __('Lesson Material Category')]) }}</th>
                    <th>{{ __('Description') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody
                class="[&>*:not(:last-child)]:border-b [&>*:not(:last-child)]:dark:border-[color-mix(in_oklab,_var(--color-white)_20%,_transparent)]
                [&>*:not(:last-child)]:border-[color-mix(in_oklab,_var(--color-zinc-800)_10%,_transparent)] [&>*]:align-top [&>*]:text-zinc-500 [&>*]:dark:text-zinc-300">
                @foreach ($items as $item)
                    <tr class="[&>*]:py-3 [&>*]:px-4 [&>*:first-child]:ps-0 [&>*:last-child]:pe-0 [&>*]:text-wrap">
                        <td>
                            {{ $items->perPage() * ($items->currentPage() - 1) + $loop->iteration }}
                        </td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->description }}
                        </td>
                        <td>
                        <td>
                            <div class="flex gap-3 justify-end">
                                <flux:button icon="pencil-line" size="sm"
                                    wire:click="$dispatch('setEditCategory',{ category: '{{ $item->id }}' })">
                                    {{ __('Edit') }}
                                </flux:button>
                                <flux:button variant="danger" icon="trash" size="sm"
                                    wire:click="$dispatch('setDeleteCategory',{ category: '{{ $item->id }}' })">
                                    {{ __('Delete') }}
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <flux:modal name="delete-category-modal" class="w-full max-w-xl">
            <livewire:lesson-material-category.delete lazy />
        </flux:modal>
        <flux:modal name="edit-category-modal" class="w-full max-w-xl">
            <livewire:lesson-material-category.edit lazy />
        </flux:modal>
        <flux:modal name="create-category-modal" class="w-full max-w-xl">
            <livewire:lesson-material-category.create lazy />
        </flux:modal>
    </div>
</div>
