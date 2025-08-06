<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen antialiased">
    <div class="w-full relative h-dvh hidden flex-col lg:flex ">
        <div class="absolute inset-0 shadow-xl bg-cover bg-center bg-no-repeat dark:after:bg-slate-900/30 dark:after:absolute dark:after:inset-0"
            style="background-image:url('{{ Vite::image('auth-bg.png') }}')"></div>
        <a href="{{ route('home') }}"
            class="px-8 py-4 self-start mt-6 rounded-e-xl dark:bg-slate-900 bg-primary-500 relative z-20 flex gap-3 items-center"
            wire:navigate>
            <x-app-logo-icon class="size-16" />
            <div>
                <div class="text-lg font-bold text-gold-400">
                    {{ config('app.name', 'Laravel') }}
                </div>
                <flux:text class="font-light text-white">
                    {{ config('app.description', 'Laravel') }}
                </flux:text>
            </div>
        </a>

        <div class="relative z-20 mt-auto ps-8 pb-8 pt-24 pe-[30%] bg-gradient-to-t from-black to-transparent text-3xl">
            <livewire:inspire lazy wire:key="inspire" />
        </div>
    </div>

    <div class="fixed inset-0 lg:left-auto grid place-items-center h-dvh overflow-auto z-40">
        <div
            class="w-full h-full flex items-center justify-center bg-gradient-to-br dark:bg-slate-900 bg-white shadow-3xl lg:rounded-s-[4rem] py-16 px-8 lg:p-12 xl:p-16">
            <div class="mx-auto relative flex w-full flex-col justify-center space-y-4">
                <div href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-1 font-medium lg:hidden"
                    wire:navigate>
                    <x-app-logo-icon class="size-24" />
                    <div class="text-lg font-bold text-cinnabar-400">
                        {{ config('app.name', 'Laravel') }}
                    </div>
                    <flux:text class="font-light">
                        {{ config('app.description', 'Laravel') }}
                    </flux:text>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    <flux:separator class="mt-4" />
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>

    <div class="absolute top-0 mt-3 left-1/2 -translate-x-1/2 bg-white rounded-lg dark:bg-slate-950 z-50">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun" />
            <flux:radio value="dark" icon="moon" />
            <flux:radio value="system" icon="computer-desktop" />
        </flux:radio.group>
    </div>
    @fluxScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" data-navigate-once></script>
</body>

</html>
