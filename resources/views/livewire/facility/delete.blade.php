<div class="space-y-6">
    <div>
        <flux:heading size="lg">{{ __('Delete :1', ['1' => __('Facility/Infrastructure')]) }}</flux:heading>
        <flux:text class="mt-2">
            <p>{{ __("You're about to delete this :1.", ['1' => Str::lower(__('Facility/Infrastructure'))]) }}</p>
            <p>{{ __('This action cannot be reversed.') }}</p>
            <p>
                {{ __('Facility/Infrastructure') . ': ' . $facility?->name }}
            </p>
        </flux:text>
    </div>
    <div class="flex gap-2">
        <flux:spacer />
        <flux:modal.close>
            <flux:button variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="danger" wire:click="delete">
            {{ __('Delete') }}
        </flux:button>
    </div>
</div>
