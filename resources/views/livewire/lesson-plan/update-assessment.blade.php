<div class="space-y-6">
    <flux:field>
        <flux:label :badge="__('Required')">{{ __('Enrichment') }}</flux:label>
        <x-textarea-wysiwyg wire:model="enrichment" />
    </flux:field>
    <flux:field>
        <flux:label :badge="__('Required')">{{ __('Remedial') }}</flux:label>
        <x-textarea-wysiwyg wire:model="remedial" />
    </flux:field>
    <div class="flex gap-2">
        <flux:spacer />
        <flux:modal.close>
            <flux:button variant="ghost">
                {{ __('Cancel') }}
            </flux:button>
        </flux:modal.close>
        <flux:button type="submit" variant="danger" wire:click="update">
            {{ __('Save Changes') }}
        </flux:button>
    </div>
</div>
