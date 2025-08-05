<div>
    <div @class([
        '[&>*]:inline-block' => $inline,
        'flex flex-col gap-1' => !$inline,
    ]) wire:ignore>
        @foreach ($items as $item)
            <livewire:attachment.item :$item wire:key="{{ $item->id }}" :$deleted />
        @endforeach
    </div>
</div>
