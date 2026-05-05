<!DOCTYPE html>
<html lang="en" class="bg-[#0f0f0f] text-[#e8e4df] selection:bg-[#d4a574] selection:text-[#0f0f0f]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botanical Archive | Premium Jewelry & Art</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=IBM+Plex+Sans:wght@300;400&family=JetBrains+Mono&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/animation.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'deep-black': '#0f0f0f',
                        'warm-text': '#e8e4df',
                        'muted-text': '#9a9590',
                        'warm-accent': '#d4a574',
                        'soft-pink': '#e8b4b8',
                        'gold': '#c9b896',
                        'terracotta': '#c4856a',
                    },
                    fontFamily: {
                        display: ['Cormorant Garamond', 'serif'],
                        body: ['Cormorant Garamond', 'serif'],
                        accent: ['IBM Plex Sans', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        .hero-title { letter-spacing: -0.02em; line-height: 0.9; }
    </style>
</head>
<body class="antialiased overflow-x-hidden">
<div class="noise"></div>
<div class="custom-cursor hidden md:block"></div>
@include('components.nav')

<main>
    @yield('content')
</main>

@include('components.footer')
<script>
    // Custom Cursor logic
    const cursor = document.querySelector('.custom-cursor');
    document.addEventListener('mousemove', (e) => {
        gsap.to(cursor, {
            x: e.clientX,
            y: e.clientY,
            duration: 0.1
        });
    });
</script>
</body>
</html>
