<!DOCTYPE html>
<html lang="en" class="bg-[#0f0f0f] text-[#e8e4df] selection:bg-[#d4a574] selection:text-[#0f0f0f]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ tenant('city') ? tenant('city') . ' | Aura Official' : 'Aura | Premium Lifestyle & Wellness' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=IBM+Plex+Sans:wght@300;400&family=JetBrains+Mono&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/animation.js'])
    <style>
        .hero-title { letter-spacing: -0.02em; line-height: 0.9; }
    </style>
</head>
<body class="antialiased overflow-x-hidden">
<div class="noise"></div>
<div class="custom-cursor hidden md:block"></div>
@include('components.nav')

<!-- Global Toast Notification -->
<div id="toast-container" class="fixed top-24 left-1/2 -translate-x-1/2 z-[150] pointer-events-none"></div>

<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const isError = type === 'error';
        
        toast.className = `bg-${isError ? 'terracotta' : 'gold'}/90 backdrop-blur-md text-${isError ? 'white' : 'deep-black'} px-8 py-3 rounded-full font-accent text-xs uppercase tracking-[0.3em] shadow-2xl flex items-center gap-3 opacity-0 translate-y-[-20px] pointer-events-auto mb-4`;
        
        const icon = isError 
            ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>'
            : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';

        toast.innerHTML = `
            ${icon}
            <span>${message}</span>
        `;
        container.appendChild(toast);

        gsap.to(toast, {
            y: 0,
            opacity: 1,
            duration: 0.5,
            ease: "power3.out"
        });

        setTimeout(() => {
            gsap.to(toast, {
                y: -20,
                opacity: 0,
                duration: 0.5,
                ease: "power3.in",
                onComplete: () => toast.remove()
            });
        }, 3000);
    }

    @if(session('success'))
        window.addEventListener('DOMContentLoaded', () => {
            showToast("{{ session('success') }}");
        });
    @endif

    @if(session('error'))
        window.addEventListener('DOMContentLoaded', () => {
            showToast("{{ session('error') }}", 'error');
        });
    @endif

    // AJAX Cart Logic
    document.addEventListener('submit', async (e) => {
        if (e.target.classList.contains('ajax-cart-form')) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;

            // Simple loading state
            button.disabled = true;
            button.innerHTML = '<span class="animate-pulse">Adding...</span>';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token')
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showToast(data.message);
                    
                    // Update Cart Count
                    const countEl = document.getElementById('cart-count');
                    if (countEl) {
                        countEl.innerText = data.cart_count;
                        // Small animation for the count
                        gsap.fromTo(countEl, { scale: 1.5 }, { scale: 1, duration: 0.5, ease: "back.out" });
                    }
                } else {
                    showToast(data.message || 'Error adding to cart.', 'error');
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                showToast('Something went wrong.', 'error');
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        }
    });
</script>

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
