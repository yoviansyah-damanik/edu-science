<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
        data-no-print>
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('home') }}"
            class="p-4 text-white flex items-center space-x-2 rtl:space-x-reverse bg-primary-500  -mx-4 -mt-4"
            wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                {{ __('Home') }}
            </flux:navlist.item>
            <flux:separator class="my-1" />

            @if (auth()->user()->isAdmin())
                <flux:navlist.group :heading="__('Modules')" class="grid">
                    @php
                        $results = \App\Models\LessonPlan::select('semester', 'year', DB::raw('count(*) as count'))
                            ->groupBy('semester', 'year')
                            ->get();
                    @endphp
                    @foreach (range(2025, now()->year) as $year)
                        <flux:navlist.group :heading="$year" expandable :expanded="now()->year == $year">
                            <flux:navlist.item
                                :href="route('lesson-plans.index', ['semester' => 'odd', 'year' => $year])"
                                wire:navigate>
                                {{ __('Odd') }}
                                <x-slot name="badge">
                                    {{ $results->where('semester', 'odd')->where('year', $year)->first()?->count ?? 0 }}
                                </x-slot>
                            </flux:navlist.item>

                            <flux:navlist.item
                                :href="route('lesson-plans.index', ['semester' => 'even', 'year' => $year])"
                                wire:navigate>
                                {{ __('Even') }}
                                <x-slot name="badge">
                                    {{ $results->where('semester', 'even')->where('year', $year)->first()?->count ?? 0 }}
                                </x-slot>
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endforeach
                </flux:navlist.group>
            @else
                <flux:navlist.group :heading="__('Modules')" class="grid">
                    @php
                        $lessonPlans = auth()->user()->lessonPlans()->get();
                    @endphp
                    @foreach (range(2025, now()->year) as $year)
                        <flux:navlist.group :heading="$year" expandable :expanded="now()->year == $year"
                            class="!cursor-pointer">
                            @php
                                $oddLessonPlan = $lessonPlans->where('semester', 'odd')->where('year', $year)->first();
                                $evenLessonPlan = $lessonPlans
                                    ->where('semester', 'even')
                                    ->where('year', $year)
                                    ->first();
                            @endphp
                            <flux:navlist.item
                                :href="!$oddLessonPlan ? route('lesson-plans.create', ['semester' => 'odd', 'year' => $year]) :
                                    route('index',
                                        $oddLessonPlan)"
                                wire:navigate>
                                {{ __('Odd') }}
                                @if ($oddLessonPlan)
                                    <x-slot name="badge">
                                        <flux:icon.check variant="micro" />
                                    </x-slot>
                                @endif
                            </flux:navlist.item>
                            <flux:navlist.item
                                :href="!$evenLessonPlan ? route('lesson-plans.create', ['semester' => 'even', 'year' =>
                                    $year
                                ]) : route('index',
                                    $evenLessonPlan)"
                                wire:navigate>
                                {{ __('Even') }}
                                @if ($evenLessonPlan)
                                    <x-slot name="badge">
                                        <flux:icon.check variant="micro" />
                                    </x-slot>
                                @endif
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endforeach
                    {{-- <flux:navlist.item icon="microscope" :href="route('lesson-plans.index')"
                    :current="request()->routeIs('lesson-plans*')"
                    :badge="Magic::limit(auth()->user()->lessonPlans->count())" badge-color="primary" wire:navigate>
                    {{ __('LPs') }}
                </flux:navlist.item>
                <flux:navlist.item icon="atom" :href="route('lesson-materials.index')"
                    :current="request()->routeIs('lesson-materials*')"
                    :badge="Magic::limit(auth()->user()->lessonMaterials->count())" badge-color="primary" wire:navigate>
                    {{ __('Lesson Materials') }}
                </flux:navlist.item>
                <flux:navlist.item icon="file-stack" :href="route('student-workshops.index')"
                    :current="request()->routeIs('student-workshops*')" badge="10" badge-color="primary"
                    wire:navigate>
                    {{ __('SWs') }}
                </flux:navlist.item>
                <flux:navlist.item icon="history" :href="route('evaluations.index')"
                    :current="request()->routeIs('evaluations*')" badge="10" badge-color="primary" wire:navigate>
                    {{ __('Evaluations') }}
                </flux:navlist.item> --}}
                </flux:navlist.group>
            @endif
        </flux:navlist>

        <flux:spacer />

        @if (auth()->user()->isAdmin())
            <flux:navlist variant="outline">
                <flux:navlist.item icon="shapes" :href="route('facilities')" wire:navigate>
                    {{ __('Facilities') . '/' . __('Infrastructures') }}
                </flux:navlist.item>
                <flux:navlist.item icon="shapes" :href="route('lesson-material-category')" wire:navigate>
                    {{ __('Lesson Material Category') }}
                </flux:navlist.item>
                {{-- <flux:navlist.item icon="users" href="https://github.com/laravel/livewire-starter-kit" wire:navigate>
                    {{ __('Users List') }}
                </flux:navlist.item> --}}
            </flux:navlist>
        @endif

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile class="cursor-pointer" :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                        <flux:radio value="light" icon="sun" />
                        <flux:radio value="dark" icon="moon" />
                        <flux:radio value="system" icon="computer-desktop" />
                    </flux:radio.group>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="settings-2" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item variant="danger" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden" data-no-print>
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                        <flux:radio value="light" icon="sun" />
                        <flux:radio value="dark" icon="moon" />
                        <flux:radio value="system" icon="computer-desktop" />
                    </flux:radio.group>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="settings-2" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
