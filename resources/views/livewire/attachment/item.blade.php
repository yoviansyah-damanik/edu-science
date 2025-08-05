<flux:dropdown id="{{ $item->id }}">
    <flux:button size="xs" icon:trailing="chevron-down" class="!ps-0 text-xs overflow-hidden group">
        <div class="max-w-60 h-8 gap-3 relative flex items-center">
            <div
                class="bg-gradient-to-r from-accent to-transparent text-accent-foreground px-3 absolute inset-y-0 left-0 hidden group-hover:grid place-items-center pe-9">
                {{ $item->filetype }}
            </div>
            <div class="ps-4 truncate my-auto">
                {{ $item->filename }}
            </div>
        </div>
    </flux:button>

    <flux:menu>
        <flux:menu.radio.group>
            <flux:menu.item icon="eye" wire:click="show">
                {{ __('Show') }}
            </flux:menu.item>
            <flux:menu.item icon="arrow-down-tray" wire:click="download">
                {{ __('Download') }}
            </flux:menu.item>
        </flux:menu.radio.group>
        @if ($deleted)
            <flux:menu.separator />
            <flux:menu.radio.group>
                <flux:menu.item icon="trash" variant="danger" wire:click="delete">
                    {{ __('Delete') }}
                </flux:menu.item>
            </flux:menu.radio.group>
        @endif
    </flux:menu>
</flux:dropdown>
