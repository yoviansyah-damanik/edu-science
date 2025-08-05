<div class="space-y-6">
    @if (!$showOnly)
        <livewire:lesson-plan.identify withPrintButton :$lessonPlan :withLetterhead="false" :title="__('Lesson Material') . ' #' . $lessonMaterial->order" />
    @endif

    <div class="space-y-2" data-area="heading">
        <div class="flex gap-3">
            <flux:heading size="xl">
                {{ __('Title') . ':' }}
            </flux:heading>
            <flux:heading level="1" size="xl">
                {{ $lessonMaterial->title }}
            </flux:heading>
        </div>
        <div class="gap-3 [&>*:not(:last-child)]:me-3 text-sm [&>*]:inline-flex [&>*]:gap-1 [&>*]:items-center">
            <div data-no-print>
                <flux:icon.user class="size-4" />
                {{ $lessonMaterial->user->name }}
            </div>
            <div>
                <flux:icon.shapes class="size-4" />
                {{ $lessonMaterial->category->name }}
            </div>
            <div>
                <flux:icon.clock class="size-4" />
                {{ $lessonMaterial->created_at->format('d/m/Y H:i:s') }}
            </div>
            @if (!$showOnly)
                @if ($lessonPlan->user_id == auth()->id())
                    <flux:link wire:navigate
                        :href="route('lesson-materials.edit', ['lessonPlan' => $lessonPlan, 'lessonMaterial' =>
                            $lessonMaterial
                        ])"
                        data-no-print>
                        <flux:icon.pencil-line class="size-4" />
                        {{ __('Edit') }}
                    </flux:link>
                    <flux:link class="cursor-pointer"
                        wire:click="$dispatch('setDeleteLessonMaterial',{ lessonMaterial: '{{ $lessonMaterial->slug }}', isRefresh:true})"
                        data-no-print>
                        <flux:icon.trash class="size-4" />
                        {{ __('Delete') }}
                    </flux:link>
                @endif
            @else
                <flux:link wire:navigate
                    :href="route('lesson-materials.show', ['lessonPlan' => $lessonPlan, 'lessonMaterial' => $lessonMaterial])"
                    data-no-print>
                    <flux:icon.eye class="size-4" />
                    {{ __('Show More') }}
                </flux:link>
            @endif
        </div>
    </div>

    @if ($lessonMaterial->youtube_url && !$showOnly)
        <flux:separator />
        <div class="print:block hidden">
            <strong>Youtube URL:</strong> {{ $lessonMaterial->youtube_url }}
        </div>
        <div class="aspect-video w-full max-w-3xl mx-auto" data-no-print>
            <iframe src="{{ Magic::convertYoutubeToEmbed($lessonMaterial->youtube_url) }}" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen class="w-full h-full">
            </iframe>
        </div>
    @endif

    <flux:separator />

    <flux:callout variant="secondary" icon="file" :heading="__('Summary')" :text="$lessonMaterial->summary"
        x-data="{ visible: true }" x-show="visible" />

    @if (!$showOnly)
        <flux:separator />
        <div data-area="content">
            {!! $lessonMaterial->content !!}
        </div>
        <flux:separator data-no-print />
        <div data-area="attachment" class="space-y-3" data-no-print>
            <flux:heading>
                {{ __('Attachments') }}
            </flux:heading>

            @if ($lessonMaterial->files->count() > 0)
                <livewire:attachment.index :items="$lessonMaterial->files" :name="'lessonMaterialAttachments-' . $lessonMaterial->id"
                    wire:key="lessonMaterialAttachments-{{ $lessonMaterial->id }}" inline />
            @else
                <div class="text-sm">
                    {{ __('No :1 found.', ['1' => Str::lower(__('Attachments'))]) }}
                </div>
            @endif
        </div>
    @endif
</div>
