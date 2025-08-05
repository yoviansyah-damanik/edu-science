@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <flux:heading level="1" class="text-cinnabar-400" size="xl">{{ $title }}</flux:heading>
    <flux:text>{{ $description }}</flux:text>
</div>
