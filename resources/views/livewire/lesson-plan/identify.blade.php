<div class="space-y-6">
    <div class="">
        <div class="items-center pb-4 border-double hidden print:flex">
            <div>
                <img src="{{ Vite::image('logo.png') }}" class="w-32" />
            </div>
            <div class="flex-1 flex flex-col text-center">
                <div class="uppercase text-xl font-semibold">
                    Pemerintah {{ $school->district_name }}
                </div>
                <div class="uppercase text-xl font-semibold">
                    Dinas Pendidikan dan Kebudayaan
                </div>
                <div class="uppercase text-3xl font-bold">
                    {{ $school->name }}
                </div>
                <div class="">
                    {{ $school->address . ', ' . __('Postal Code') . ': ' . $school->postal_code }}
                </div>
                <div class="flex gap-3 justify-center">
                    <div>
                        {{ __('Email') . ': ' . $school->email }}
                    </div>
                    <div>
                        {{ __('Phone Number') . ': ' . $school->phone_number }}
                    </div>
                </div>
            </div>
        </div>

        @if ($title)
            <div
                class="py-4 border-b-4 border-double border-t-4 font-bold text-center uppercase text-xl text-red-700 tracking-widest">
                {{ $title }}
            </div>
        @endif
    </div>

    <flux:callout variant="secondary">
        <div class="flex md:items-center flex-col md:flex-row gap-4 mb-4">
            <flux:callout.heading icon="folder-open">
                {{ __('Module Identify') }}
            </flux:callout.heading>
            <div class="[&>*]:cursor-pointer [&>*]:inline-flex [&>*]:items-center text-sm [&>*]:gap-1 flex gap-3"
                data-no-print>
                @if ($withEditButton)
                    @if ($lessonPlan->user_id == auth()->id())
                        <flux:link :href="route('edit', $lessonPlan)" wire:navigate>
                            <flux:icon.pencil-line class="size-4" />
                            {{ __('Edit') }}
                        </flux:link>
                    @endif
                @endif
                @if ($lessonPlan->user_id == auth()->id() || auth()->user()->isAdmin())
                    <flux:link :href="route('show', $lessonPlan)" wire:navigate>
                        <flux:icon.eye class="size-4" />
                        {{ __('Show More') }}
                    </flux:link>
                    @if ($withPrintButton)
                        <flux:link class="cursor-pointer" x-on:click="printArea" data-no-print>
                            <flux:icon.printer class="size-4" />
                            {{ __('Print') }}
                        </flux:link>
                    @endif
                @endif
            </div>
        </div>
        <flux:callout.text>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-2 [&>*]:odd:font-semibold">
                <div>
                    {{ __("Author's Name") }}
                </div>
                <div>
                    {{ $lessonPlan->user->name }}
                </div>
                <div>
                    {{ __('Time Allocation') }}
                </div>
                <div>
                    {{ $lessonPlan->time_allocation }}
                </div>
                <div>
                    {{ __('Educational Unit') }}
                </div>
                <div>
                    {{ Magic::schoolProfile()->name }}
                </div>
                <div>
                    {{ __('Year of Preparation') }}
                </div>
                <div>
                    {{ $lessonPlan->year }}
                </div>
                <div>
                    {{ __('Class') . '/' . __('Semester') }}
                </div>
                <div>
                    {{ $lessonPlan->class . '/' . __(Str::title($lessonPlan->semester)) }}
                </div>
                <div>
                    {{ __('Phase') }}
                </div>
                <div>
                    {{ $lessonPlan->phase }}
                </div>
                <div>
                    {{ __('Subject') }}
                </div>
                <div>
                    {{ $lessonPlan->subject }}
                </div>
                <div>
                    {{ __('Subject Element') }}
                </div>
                <div>
                    {{ $lessonPlan->subject_element }}
                </div>
            </div>
        </flux:callout.text>
    </flux:callout>
</div>
