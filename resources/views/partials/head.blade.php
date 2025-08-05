<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="{{ Vite::image('logo-min.png') }}" sizes="any">
<link rel="icon" href="{{ Vite::image('logo-min.png') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ Vite::image('logo-min.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" data-navigate-once />

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" data-navigate-once />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
@stack('styles')
