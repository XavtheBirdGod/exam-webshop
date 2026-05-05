<nav id="main-nav" class="fixed top-0 w-full z-[100] px-8 py-6 transition-all duration-700">
    <div class="max-w-[1440px] mx-auto grid grid-cols-3 items-center">

        <!-- Left: Secondary Navigation or Search -->
        <div class="flex items-center gap-8">
            <button class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <span class="hidden lg:inline">Search</span>
            </button>
            <button class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-colors hidden md:block">
                Locations
            </button>
        </div>

        <!-- Center: Branding -->
        <div class="flex justify-center">
            <a href="/" class="group">
                <h1 class="font-display text-4xl tracking-[0.5em] text-warm-text uppercase transition-all duration-500 group-hover:text-gold group-hover:tracking-[0.6em]">
                    Rituals
                </h1>
            </a>
        </div>

        <!-- Right: Utility & Cart -->
        <div class="flex justify-end items-center gap-8">
            <a href="/account" class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-warm-text hidden sm:block">
                Account
            </a>
            <a href="/cart" class="relative group flex items-center">
                <span class="font-accent text-[10px] uppercase tracking-[0.3em] text-warm-text mr-3">Bag</span>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-warm-text group-hover:text-gold transition-colors">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span class="absolute -top-1 -right-2 bg-warm-accent text-deep-black text-[9px] font-bold h-4 w-4 flex items-center justify-center rounded-full">0</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Sub-Navigation: The Actual Categories -->
    <div id="sub-nav" class="w-full mt-6 flex justify-center gap-12 border-t border-muted-text/10 pt-6 transition-all duration-500">
        <a href="{{ route('collections') }}" class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-all duration-300 relative group">
            Collections
            <span class="absolute -bottom-1 left-0 w-0 h-px bg-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('shop') }}" class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-all duration-300 relative group">
            Shop All
            <span class="absolute -bottom-1 left-0 w-0 h-px bg-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('sustainability') }}" class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-all duration-300 relative group">
            Sustainability
            <span class="absolute -bottom-1 left-0 w-0 h-px bg-gold transition-all duration-300 group-hover:w-full"></span>
        </a>
    </div>
</nav>

<script>
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('main-nav');
        const subNav = document.getElementById('sub-nav');
        if (window.scrollY > 50) {
            nav.classList.add('bg-deep-black/90', 'backdrop-blur-xl', 'py-4');
            nav.classList.remove('py-6');
            subNav.classList.add('opacity-0', 'h-0', 'mt-0', 'pointer-events-none');
            subNav.classList.remove('opacity-100', 'mt-6');
        } else {
            nav.classList.remove('bg-deep-black/90', 'backdrop-blur-xl', 'py-4');
            nav.classList.add('py-6');
            subNav.classList.remove('opacity-0', 'h-0', 'mt-0', 'pointer-events-none');
            subNav.classList.add('opacity-100', 'mt-6');
        }
    });
</script>
