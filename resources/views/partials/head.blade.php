<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

{{-- PWA: Web App Manifest --}}
<link rel="manifest" href="/manifest.json">

{{-- PWA: Theme color for browser chrome --}}
<meta name="theme-color" content="#18181b">

{{-- PWA: Standard mobile web app meta --}}
<meta name="mobile-web-app-capable" content="yes">

{{-- PWA: Apple-specific meta tags --}}
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Laravel') }}">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="192x192" href="/icons/icon-192x192.png">
<link rel="apple-touch-icon" sizes="512x512" href="/icons/icon-512x512.png">

{{-- Favicons --}}
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance