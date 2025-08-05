<div x-data='{
    id: $id("{{ Str::of($attributes->whereStartsWith('wire:model')->first())->explode('.')[0] }}"),
    content: $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} ?? "",
    get result() {
        $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} = this.content;
        return content;
    }
}'
    x-on:clear-textarea.window = "content = ''"
    x-on:set-{{ $attributes->whereStartsWith('wire:model')->first() }}-textarea-value.window = "content = $event.detail[0]">
    <div class="relative">
        <div wire:ignore @class(['disabled' => !$attachmentButton])>
            <trix-editor
                x-on:trix-change="$wire.{{ $attributes->whereStartsWith('wire:model')->first() }} = $event.target.value"
                class="{{ $baseClass }}" {{ $attributes->whereStartsWith('wire:model') }} wire:loading.attr='disabled'
                @required($required) @disabled($loading)></trix-editor>
        </div>
    </div>
</div>
