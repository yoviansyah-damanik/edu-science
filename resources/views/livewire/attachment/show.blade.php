<div class="space-y-6">
    @if ($item)
        <div>
            <flux:heading size="lg">{{ __('Preview') . ': ' . $item->filename }}</flux:heading>
        </div>
        <flux:separator />
        <div class="h-full max-h-[600px] overflow-auto">
            @if (in_array($item->filetype, ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif', 'svg']))
                <img src="{{ asset($item->url) }}" class="max-w-full" />
            @elseif($item->filetype == 'pdf')
                <iframe src="{{ asset($item->url) }}" class="w-full h-[580px]" frameborder="0"></iframe>
            @else
                {{ __('The file cannot be previewed. Please download the file.') }}
            @endif
        </div>
        <flux:separator />
        <div class="flex justify-end gap-1">
            <flux:modal.close>
                <flux:button variant="ghost">
                    {{ __('Close') }}
                </flux:button>
            </flux:modal.close>
            <flux:button variant="primary" icon="arrow-down-tray" wire:click="download">
                {{ __('Download') }}
            </flux:button>
        </div>
    @endif
</div>
