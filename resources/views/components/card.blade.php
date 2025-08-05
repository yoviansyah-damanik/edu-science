<div
    class="bg-white dark:bg-white/10 border border-zinc-200 dark:border-white/10 [:where(&)]:px-6 [:where(&)]:pb-6 [:where(&)]:pt-8 [:where(&)]:rounded-xl space-y-6 relative">
    @if ($legend)
        <div
            class="absolute top-0 -translate-y-[.75rem] text-black bg-white border-zinc-200 dark:border-white/10 rounded px-4">
            {{ $legend }}
        </div>
    @endif
    {{ $slot }}
</div>
