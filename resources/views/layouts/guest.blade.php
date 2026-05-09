<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SoulSync — Access</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --bg-dark: #0a0e1a;
            --card-bg: rgba(17, 24, 39, 0.85);
            --card-border: rgba(255, 255, 255, 0.06);
            --text-primary: #f1f5f9;
            --accent: #38bdf8;
        }

        body {
            background: #0a0e1a;
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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
        }

        .glass-card {
            background: var(--card-bg) !important;
            backdrop-filter: blur(20px) !important;
            border: 1px solid var(--card-border) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid var(--card-border) !important;
            color: white !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem 1rem !important;
            font-family: 'Inter', sans-serif !important;
            transition: all 0.25s ease !important;
        }

        input:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1) !important;
        }

        label {
            color: #64748b !important;
            font-weight: 500 !important;
            font-size: 0.8125rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
        }

        button[type="submit"], .inline-flex {
            background: linear-gradient(135deg, #0ea5e9, #6366f1, #8b5cf6) !important;
            background-size: 200% auto !important;
            border: none !important;
            border-radius: 0.75rem !important;
            font-weight: 700 !important;
            transition: all 0.3s ease !important;
            font-family: 'Inter', sans-serif !important;
        }

        button[type="submit"]:hover, .inline-flex:hover {
            background-position: right center !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3) !important;
        }

        a {
            color: var(--accent) !important;
            transition: opacity 0.2s !important;
        }
        a:hover { opacity: 0.8 !important; }

        .text-gray-600, .text-gray-500 { color: #64748b !important; }
        .text-gray-800, .text-gray-900 { color: #f1f5f9 !important; }
        .text-sm { font-family: 'Inter', sans-serif !important; }

        input[type="checkbox"] {
            accent-color: var(--accent);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="position: relative; z-index: 1;">
        <div style="margin-bottom: 1rem;">
            <a href="/" style="text-decoration: none;">
                <div style="font-weight: 900; font-size: 2.5rem; background: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SoulSync</div>
            </a>
            <p style="text-align: center; color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Your safe space for reflection</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-8 glass-card overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>

        <p style="margin-top: 2rem; color: #475569; font-size: 0.75rem;">© {{ date('Y') }} SoulSync. All rights reserved.</p>
    </div>
</body>
</html>
