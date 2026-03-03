<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Offline — {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#18181b">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #18181b;
            color: #f4f4f5;
            min-height: 100svh;
            display: grid;
            place-items: center;
            padding: 2rem;
        }

        .card {
            background: #27272a;
            border: 1px solid #3f3f46;
            border-radius: 1.25rem;
            padding: 3rem 2.5rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 1rem;
            background: linear-gradient(135deg, #6d28d9, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .icon-wrap svg {
            width: 36px;
            height: 36px;
            stroke: white;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f4f4f5;
            margin-bottom: 0.75rem;
        }

        p {
            font-size: 0.9375rem;
            color: #a1a1aa;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #6d28d9, #4f46e5);
            color: white;
            font-size: 0.9375rem;
            font-weight: 500;
            padding: 0.65rem 1.5rem;
            border-radius: 0.625rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s ease;
        }

        .btn:hover {
            opacity: 0.88;
        }

        .status {
            margin-top: 1.5rem;
            font-size: 0.8125rem;
            color: #71717a;
        }

        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            margin-right: 0.4rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon-wrap">
            <svg viewBox="0 0 24 24">
                <path d="M1 6l10.5 6L22 6M1 6v12l10.5 6L22 18V6M1 6l10.5 6L22 6" />
                <line x1="12" y1="6.5" x2="12" y2="12" />
            </svg>
        </div>

        <h1>You're offline</h1>
        <p>It looks like you've lost your internet connection. Please check your network and try again.</p>

        <button class="btn" onclick="window.location.reload()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 4 23 10 17 10" />
                <polyline points="1 20 1 14 7 14" />
                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15" />
            </svg>
            Try again
        </button>

        <div class="status">
            <span class="dot"></span>No connection detected
        </div>
    </div>
</body>

</html>