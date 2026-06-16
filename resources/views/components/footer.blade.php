<footer class="bg-[#0a0a0a] border-t border-muted-text/5 pt-32 pb-16 px-8" x-data="{ cookieModal: false, analytics: true, marketing: false }">
    <!-- Cookie Settings Modal -->
    <div x-show="cookieModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[200] flex items-center justify-center px-6 bg-deep-black/90 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-[#161615] border border-white/10 p-10 max-w-lg w-full rounded-3xl reveal" @click.away="cookieModal = false">
            <h3 class="font-display text-3xl mb-6 italic">Cookie Preferences</h3>
            <p class="font-body text-sm text-muted-text mb-8 leading-relaxed">
                We use cookies to enhance your experience, analyze site traffic, and serve personalized content. Please select your preferences below.
            </p>
            
            <div class="space-y-6 mb-10">
                <div class="flex items-center justify-between p-4 border border-white/5 rounded-xl">
                    <div>
                        <p class="font-accent text-[10px] uppercase tracking-widest text-warm-text">Essential Cookies</p>
                        <p class="font-body text-[10px] text-muted-text">Required for the website to function.</p>
                    </div>
                    <div class="w-10 h-5 bg-gold/20 rounded-full relative">
                        <div class="absolute right-1 top-1 w-3 h-3 bg-gold rounded-full"></div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-4 border border-white/5 rounded-xl">
                    <div>
                        <p class="font-accent text-[10px] uppercase tracking-widest text-warm-text">Analytical Cookies</p>
                        <p class="font-body text-[10px] text-muted-text">Helps us improve our ritual services.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="analytics" class="sr-only peer">
                        <div class="w-10 h-5 bg-white/10 peer-checked:bg-gold/40 rounded-full transition-colors"></div>
                        <div class="absolute left-1 top-1 w-3 h-3 bg-muted-text peer-checked:bg-gold peer-checked:translate-x-5 rounded-full transition-all"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 border border-white/5 rounded-xl">
                    <div>
                        <p class="font-accent text-[10px] uppercase tracking-widest text-warm-text">Marketing Cookies</p>
                        <p class="font-body text-[10px] text-muted-text">Used to show you relevant wellness content.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" x-model="marketing" class="sr-only peer">
                        <div class="w-10 h-5 bg-white/10 peer-checked:bg-gold/40 rounded-full transition-colors"></div>
                        <div class="absolute left-1 top-1 w-3 h-3 bg-muted-text peer-checked:bg-gold peer-checked:translate-x-5 rounded-full transition-all"></div>
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <x-button class="flex-1" @click="cookieModal = false; showToast('Your preferences have been saved.')">Save Preferences</x-button>
                <x-button variant="outline" class="flex-1" @click="analytics = true; marketing = true; cookieModal = false; showToast('All cookies accepted.')">Accept All</x-button>
            </div>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-20 mb-32">
        <div class="lg:col-span-4">
            <h1 class="font-display text-4xl text-warm-text uppercase tracking-[0.5em] mb-8">Rituals</h1>
            <p class="font-body text-lg text-muted-text leading-relaxed max-w-sm mb-10">
                Happiness can be found in the smallest of things. It is our passion to turn your everyday routines into more meaningful rituals.
            </p>
            <div class="flex gap-6">
                @php
                    $socials = [
                        'instagram' => 'https://www.instagram.com/ritualscosmetics/',
                        'facebook' => 'https://www.facebook.com/RitualsCosmetics/',
                        'pinterest' => 'https://www.pinterest.com/ritualsofficial/'
                    ];
                @endphp
                @foreach($socials as $name => $url)
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-muted-text hover:text-gold transition-colors">
                        <span class="font-accent text-[10px] uppercase tracking-widest">{{ $name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">Collections</h4>
            <ul class="font-body text-base text-muted-text space-y-6">
                <li><a href="{{ tenant() ? route('collections') : route('home') }}" class="hover:text-gold transition-colors">The Collections</a></li>
                <li><a href="{{ tenant() ? route('shop') : route('home') }}" class="hover:text-gold transition-colors">Body Care</a></li>
                <li><a href="{{ tenant() ? route('shop') : route('home') }}" class="hover:text-gold transition-colors">Home Ambiance</a></li>
                <li><a href="{{ tenant() ? route('shop') : route('home') }}" class="hover:text-gold transition-colors">Gift Sets</a></li>
            </ul>
        </div>

        <div class="lg:col-span-2">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">Care</h4>
            <ul class="font-body text-base text-muted-text space-y-6">
                <li><a href="{{ tenant() ? route('sustainability') : route('home') }}" class="hover:text-gold transition-colors">Sustainability</a></li>
                <li><a href="{{ tenant() ? 'http://' . config('tenancy.central_domains')[1] . ':' . request()->getPort() : route('home') }}" class="hover:text-gold transition-colors">Store Locator</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-gold transition-colors">Contact Us</a></li>
                <li><a href="{{ route('careers') }}" class="hover:text-gold transition-colors">Careers</a></li>
            </ul>
        </div>

        <div class="lg:col-span-4">
            <h4 class="font-accent text-[11px] uppercase tracking-[0.3em] text-gold mb-10">The Newsletter</h4>
            <p class="font-body text-sm text-muted-text mb-8">Join our community and receive a gift with your first order.</p>
            <form id="newsletter-form" class="relative group">
                <input type="email" required placeholder="YOUR EMAIL ADDRESS" class="w-full bg-transparent border-b border-muted-text/20 py-4 focus:border-gold outline-none text-warm-text font-accent text-[10px] tracking-widest transition-all">
                <button type="submit" class="absolute right-0 bottom-4 text-gold font-accent text-[10px] uppercase tracking-[0.4em] hover:tracking-[0.6em] transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('newsletter-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            const input = e.target.querySelector('input');
            showToast('Welcome to our community! Please check ' + input.value + ' to confirm.');
            input.value = '';
        });
    </script>

    <div class="max-w-[1440px] mx-auto pt-12 border-t border-muted-text/5 flex flex-col md:flex-row justify-between items-center gap-8">
        <p class="font-mono text-[10px] text-muted-text uppercase tracking-widest">© 2026 Rituals Cosmetics Enterprise B.V.</p>
        <div class="flex gap-12 font-mono text-[10px] text-muted-text uppercase tracking-widest">
            <a href="{{ route('privacy') }}" class="hover:text-warm-text transition-colors">Privacy Policy</a>
            <a href="{{ route('terms') }}" class="hover:text-warm-text transition-colors">Terms of Service</a>
            <button @click="cookieModal = true" class="hover:text-warm-text transition-colors uppercase">Cookie Settings</button>
        </div>
    </div>
</footer>
