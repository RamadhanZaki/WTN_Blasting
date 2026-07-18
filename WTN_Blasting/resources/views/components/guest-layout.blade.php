<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - WTN BLASTING</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        wtn: { dark: '#0a0a0a', orange: '#ff6a00', amber: '#ffb703', steel: '#3a3a3a' }
                    },
                    boxShadow: { glow: '0 0 40px -10px rgba(255,106,0,.45)' }
                }
            }
        }
    </script>
    <style>
        body { background-color: #0a0a0a; }
        .bg-grid {
            background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 42px 42px;
        }
    </style>
</head>
<body class="bg-wtn-dark text-neutral-100 font-sans antialiased min-h-screen flex items-center justify-center px-4 py-10 bg-grid relative overflow-hidden">

    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-wtn-orange/20 blur-[160px] rounded-full pointer-events-none"></div>

    <div class="relative w-full max-w-md">
        {{ $slot }}
    </div>

</body>
</html>
