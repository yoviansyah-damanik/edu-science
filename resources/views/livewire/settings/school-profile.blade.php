<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('School Profile')" :subheading="__('Ensure that the school profile is accurate.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('School Name')" type="text" required autofocus
                autocomplete="name" />
            <flux:input wire:model="address" :label="__('Address')" type="text" required autofocus
                autocomplete="address" />
            <flux:input wire:model="postalCode" :label="__('Postal Code')" type="text" required autofocus
                autocomplete="postalCode" />
            <flux:input wire:model="districtName" :label="__('District Name')" type="text" required autofocus
                autocomplete="districtName" />
            <flux:input wire:model="phoneNumber" :label="__('Phone Number')" type="text" required autofocus
                autocomplete="phoneNumber" />
            <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />
            <flux:select wire:model="status" :label="__('Status')">
                @foreach ($statuses as $item)
                    <flux:select.option :value="$item">{{ $item }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select wire:model="accreditation" :label="__('Accreditation')">
                @foreach ($accreditations as $item)
                    <flux:select.option :value="$item">{{ $item }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select wire:model="level" :label="__('Level')">
                @foreach ($levels as $item)
                    <flux:select.option :value="$item">{{ $item }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input wire:model="achievement" :label="__('Achievement')" type="text" required autofocus
                autocomplete="achievement" />
            <flux:input wire:model="studyHours" :label="__('Study Hours')" type="text" required autofocus
                autocomplete="studyHours" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
