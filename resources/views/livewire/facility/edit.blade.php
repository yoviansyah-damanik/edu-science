<div class="space-y-6">
    <div>
        <flux:heading size="lg">{{ __('Edit :1', ['1' => __('Facility/Infrastructure')]) }}</flux:heading>
    </div>
    <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />
    <div class="flex gap-2">
        <flux:spacer />
        <flux:modal.close>
            <flux:button variant="ghost">
                {{ __('Close') }}
            </flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="primary" wire:click="update">
            {{ __('Save Changes') }}
        </flux:button>
    </div>
</div>
