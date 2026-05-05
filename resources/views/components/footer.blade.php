<footer class="bg-[#0a0a0a] border-t border-muted-text/5 pt-32 pb-16 px-8">
    <div class="max-w-[1440px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-20 mb-32">
        <div class="lg:col-span-4">
            <h1 class="font-display text-4xl text-warm-text uppercase tracking-[0.5em] mb-8">Rituals</h1>
            <p class="font-body text-lg text-muted-text leading-relaxed max-w-sm mb-10">
                Happiness can be found in the smallest of things. It is our passion to turn your everyday routines into more meaningful rituals.
            </p>
            <div class="flex gap-6">
                @foreach(['instagram', 'facebook', 'pinterest'] as $social)
                    <a href="#" class="text-muted-text hover:text-gold transition-colors">
                        <span class="font-accent text-[10px] uppercase tracking-widest">{{ $social }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">Collections</h4>
            <ul class="font-body text-base text-muted-text space-y-6">
                <li><a href="{{ route('collections') }}" class="hover:text-gold transition-colors">The Collections</a></li>
                <li><a href="{{ route('shop') }}" class="hover:text-gold transition-colors">Body Care</a></li>
                <li><a href="{{ route('shop') }}" class="hover:text-gold transition-colors">Home Ambiance</a></li>
                <li><a href="{{ route('shop') }}" class="hover:text-gold transition-colors">Gift Sets</a></li>
            </ul>
        </div>

        <div class="lg:col-span-2">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">Care</h4>
            <ul class="font-body text-base text-muted-text space-y-6">
                <li><a href="{{ route('sustainability') }}" class="hover:text-gold transition-colors">Sustainability</a></li>
                <li><a href="#" class="hover:text-gold transition-colors">Store Locator</a></li>
                <li><a href="#" class="hover:text-gold transition-colors">Contact Us</a></li>
                <li><a href="#" class="hover:text-gold transition-colors">Careers</a></li>
            </ul>
        </div>

        <div class="lg:col-span-4">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">The Newsletter</h4>
            <p class="font-body text-sm text-muted-text mb-8">Join our community and receive a gift with your first order.</p>
            <form class="relative group">
                <input type="email" placeholder="YOUR EMAIL ADDRESS" class="w-full bg-transparent border-b border-muted-text/20 py-4 focus:border-gold outline-none text-warm-text font-accent text-[10px] tracking-widest transition-all">
                <button type="submit" class="absolute right-0 bottom-4 text-gold font-accent text-[10px] uppercase tracking-[0.4em] hover:tracking-[0.6em] transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto pt-12 border-t border-muted-text/5 flex flex-col md:flex-row justify-between items-center gap-8">
        <p class="font-mono text-[10px] text-muted-text uppercase tracking-widest">© 2026 Rituals Cosmetics Enterprise B.V.</p>
        <div class="flex gap-12 font-mono text-[10px] text-muted-text uppercase tracking-widest">
            <a href="#" class="hover:text-warm-text transition-colors">Privacy Policy</a>
            <a href="#" class="hover:text-warm-text transition-colors">Terms of Service</a>
            <a href="#" class="hover:text-warm-text transition-colors">Cookie Settings</a>
        </div>
    </div>
</footer>
