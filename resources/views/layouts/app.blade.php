<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SoulSync') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            :root {
                --bg-dark: #0a0e1a;
                --bg-surface: #111827;
                --card-bg: rgba(17, 24, 39, 0.85);
                --card-border: rgba(255, 255, 255, 0.06);
                --text-primary: #f1f5f9;
                --text-secondary: #64748b;
                --accent: #38bdf8;
                --gradient: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #c084fc 100%);
                --gradient-btn: linear-gradient(135deg, #0ea5e9, #6366f1, #8b5cf6);
            }

            body {
                background: var(--bg-dark) !important;
                color: var(--text-primary) !important;
                font-family: 'Inter', sans-serif !important;
                min-height: 100vh;
            }

            body::before {
                content: '';
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background:
                    radial-gradient(ellipse at 20% 0%, rgba(56, 189, 248, 0.08) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 100%, rgba(129, 140, 248, 0.06) 0%, transparent 50%);
                pointer-events: none;
                z-index: 0;
            }

            /* Override Tailwind defaults for dark theme */
            .bg-gray-100, .bg-white { background: transparent !important; }
            .bg-white.shadow { background: var(--card-bg) !important; backdrop-filter: blur(20px); border: 1px solid var(--card-border) !important; box-shadow: none !important; }
            .text-gray-900, .text-gray-800, .text-gray-700 { color: var(--text-primary) !important; }
            .text-gray-600, .text-gray-500, .text-gray-400 { color: var(--text-secondary) !important; }
            .border-gray-100, .border-gray-200, .border-gray-300 { border-color: var(--card-border) !important; }

            /* Navigation */
            nav.bg-white { background: rgba(17, 24, 39, 0.6) !important; backdrop-filter: blur(20px); border-bottom: 1px solid var(--card-border) !important; }
            nav button, nav a { color: var(--text-secondary) !important; }
            nav button:hover, nav a:hover { color: white !important; }

            /* Cards */
            .sm\\:rounded-lg { border-radius: 1rem !important; border: 1px solid var(--card-border) !important; }
            .p-4.sm\\:p-8.bg-white.shadow { background: var(--card-bg) !important; backdrop-filter: blur(16px); }

            /* Inputs */
            input[type="text"], input[type="email"], input[type="password"] {
                background: rgba(0, 0, 0, 0.3) !important;
                border: 1px solid var(--card-border) !important;
                color: white !important;
                border-radius: 0.75rem !important;
            }
            input:focus {
                border-color: var(--accent) !important;
                box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1) !important;
                --tw-ring-color: transparent !important;
            }

            /* Labels */
            label { color: var(--text-secondary) !important; }

            /* Buttons */
            .inline-flex.items-center.px-4 {
                background: var(--gradient-btn) !important;
                border: none !important;
                border-radius: 0.75rem !important;
            }
            button.bg-red-600, .bg-red-600 {
                background: linear-gradient(135deg, #ef4444, #dc2626) !important;
                border-radius: 0.75rem !important;
            }
            button.bg-white, .bg-white.border { 
                background: rgba(255,255,255,0.06) !important; 
                border: 1px solid var(--card-border) !important; 
                color: var(--text-primary) !important; 
            }

            /* Modal */
            [x-show][x-transition] .bg-white {
                background: var(--bg-surface) !important;
                border: 1px solid var(--card-border) !important;
            }

            /* Dropdown */
            .rounded-md.shadow-lg { background: var(--bg-surface) !important; border: 1px solid var(--card-border) !important; }
            .block.w-full.px-4.py-2 { color: var(--text-secondary) !important; }
            .block.w-full.px-4.py-2:hover { background: rgba(255,255,255,0.06) !important; color: white !important; }

            /* Green text for success */
            .text-green-600 { color: #34d399 !important; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="position: relative; z-index: 1;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header style="background: var(--card-bg); backdrop-filter: blur(20px); border-bottom: 1px solid var(--card-border);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
