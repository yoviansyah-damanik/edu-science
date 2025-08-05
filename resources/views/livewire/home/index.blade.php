<div class="space-y-6">
    <div class="hidden md:block md:h-48 md:bg-left h-80 rounded-2xl mx-auto overflow-hidden w-full bg-center -z-10"
        style="background-image: url('{{ Vite::image('auth-bg-2.png') }}')">
    </div>

    <flux:callout variant="secondary" icon="information-circle"
        :heading="__('Welcome back, :1!',['1'=>auth()->user()->name])" />

    <flux:callout variant="primary">
        <flux:callout.heading icon="school">
            {{ __('School Profile') }}
        </flux:callout.heading>
        <flux:callout.text>
            <div
                class="flex flex-col md:grid md:grid-cols-4 gap-x-4 gap-y-2 [&>*]:odd:font-semibold [&>*]:odd:flex [&>*]:odd:gap-1">
                <div>
                    {{-- <flux:icon.school variant="micro" /> --}}
                    {{ __('School Name') }}
                </div>
                <div>
                    {{ $school->name }}
                </div>
                <div>
                    {{-- <flux:icon.map-pin-house variant="micro" /> --}}
                    {{ __('Address') }}
                </div>
                <div>
                    {{ $school->address . ', ' . $school->district_name . ', ' . $school->postal_code }}
                </div>
                <div>
                    {{-- <flux:icon.chart-no-axes-column-increasing variant="micro" /> --}}
                    {{ __('Status') }}
                </div>
                <div>
                    {{ $school->status }}
                </div>
                <div>
                    {{-- <flux:icon.case-upper variant="micro" /> --}}
                    {{ __('Accreditation') }}
                </div>
                <div>
                    {{ $school->accreditation }}
                </div>
                <div>
                    {{-- <flux:icon.trending-up variant="micro" /> --}}
                    {{ __('Level') }}
                </div>
                <div>
                    {{ $school->level }}
                </div>
                <div>
                    {{-- <flux:icon.medal variant="micro" /> --}}
                    {{ __('Achievement') }}
                </div>
                <div>
                    {{ $school->achievement }}
                </div>
                <div>
                    {{-- <flux:icon.clock variant="micro" /> --}}
                    {{ __('Study Hours') }}
                </div>
                <div>
                    {{ $school->study_hours }}
                </div>
            </div>
        </flux:callout.text>
    </flux:callout>

    @if (auth()->user()->isAdmin())
        <livewire:home.administrator />
    @else
        <livewire:home.user />
    @endif
</div>
