<div class="grid grid-cols-3 gap-4">
    @foreach (range(2025, now()->year) as $year)
        <div
            class="[--callout-background:var(--color-white)] [--callout-border:var(--color-zinc-200)] [--callout-heading:var(--color-zinc-800)] [--callout-icon:var(--color-zinc-400)] [--callout-text:var(--color-zinc-500)] bg-(--callout-background) border border-(--callout-border) dark:[--callout-background:color-mix(in_oklab,var(--color-zinc-400),transparent_90%)] dark:[--callout-border:color-mix(in_oklab,var(--color-white),transparent_95%)] dark:[--callout-heading:var(--color-zinc-200)] dark:[--callout-icon:var(--color-zinc-400)] dark:[--callout-text:var(--color-zinc-300)] rounded-lg overflow-hidden">
            <div class="text-xl bg-primary-100 dark:bg-primary-950 text-center font-semibold py-2">
                {{ $year }}
            </div>
            <div class="flex [&>*]:py-2 [&>*]:flex [&>*]:justify-center [&>*]:gap-1 [&>*]:items-center">
                @php
                    $evenLessonPlan = $lessonPlans->where('semester', 'even')->where('year', $year)->first();
                    $oddLessonPlan = $lessonPlans->where('semester', 'odd')->where('year', $year)->first();
                @endphp

                <flux:button variant="ghost" class="flex-1"
                    :href="!$oddLessonPlan ? route('lesson-plans.create', ['semester' => 'odd', 'year' => $year]) :
                        route('index',
                            $oddLessonPlan)"
                    wire:navigate>
                    {{ __('Odd') }}
                    @if ($lessonPlans->where('year', $year)->where('semester', 'odd')->first())
                        <flux:icon.check variant="mini" class="text-green-500" />
                    @else
                        <flux:icon.x variant="mini" class="text-red-500" />
                    @endif
                </flux:button>
                <flux:button variant="ghost" class="flex-1"
                    :href="!$evenLessonPlan ? route('lesson-plans.create', ['semester' => 'even', 'year' => $year]) :
                        route('index',
                            $evenLessonPlan)"
                    wire:navigate>
                    {{ __('Even') }}
                    @if ($lessonPlans->where('year', $year)->where('semester', 'even')->first())
                        <flux:icon.check variant="mini" class="text-green-500" />
                    @else
                        <flux:icon.x variant="mini" class="text-red-500" />
                    @endif
                </flux:button>
            </div>
        </div>
    @endforeach
</div>
