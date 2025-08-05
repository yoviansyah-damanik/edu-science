@props([
    'container' => null,
])

@php
    $classes = Flux::classes('[grid-area:main]')
        ->add('p-6 lg:p-8 relative')
        ->add('[[data-flux-container]_&]:px-0') // If there is a wrapping container, let IT handle the x padding...
        ->add($container ? 'mx-auto w-full [:where(&)]:max-w-7xl' : '');
@endphp

<div {{ $attributes->class($classes) }} data-flux-main x-data="{
    originalFontSize: '',

    printArea() {
        // Simpan dark mode
        var darkMode = $flux.dark;
        $flux.dark = false;

        // Simpan ukuran font saat ini
        this.originalFontSize = document.documentElement.style.fontSize || getComputedStyle(document.documentElement).fontSize;

        // Ubah ukuran font menjadi 10pt
        document.documentElement.style.fontSize = '10pt';

        // Tunggu print selesai, lalu kembalikan ke semula
        const afterPrint = () => {
            document.documentElement.style.fontSize = this.originalFontSize;
            $flux.dark = darkMode;
            window.removeEventListener('afterprint', afterPrint);
        };

        window.addEventListener('afterprint', afterPrint);
        window.print();
    }
}">
    {{ $slot }}
</div>
