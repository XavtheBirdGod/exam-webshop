@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-[100dvh] flex items-center px-6 pt-24 pb-12 max-w-[1280px] mx-auto overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center w-full">

            <!-- Text Content -->
            <div class="md:col-span-7 z-10">
                <div class="reveal">
                <span class="font-accent text-warm-accent uppercase tracking-[0.2em] text-[10px] mb-6 block">
                    Est. 2026 — Archive Collection
                </span>
                    <h1 class="font-display font-bold text-[clamp(2.5rem,8vw,5rem)] leading-[0.9] mb-8 text-warm-text">
                        Botanical <br>
                        <span class="italic font-normal text-gold">Mysticism</span>
                    </h1>
                    <p class="font-body text-lg max-w-[42ch] text-muted-text mb-12 leading-relaxed">
                        A curated selection of luxury artifacts where raw nature meets refined craftsmanship. Designed for those who appreciate the beauty of the shadows.
                    </p>

                    <div class="flex flex-wrap gap-6 items-center">
                        <a href="{{ route('shop') }}" class="group relative px-10 py-4 bg-warm-accent text-deep-black rounded-full font-semibold transition-all hover:scale-105 active:translate-y-1 overflow-hidden">
                            <span class="relative z-10">Explore Archive</span>
                        </a>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-accent text-xs uppercase tracking-widest text-warm-text hover:text-gold transition-colors">Go to Account</a>
                            @else
                                <a href="{{ route('login') }}" class="font-accent text-xs uppercase tracking-widest text-warm-text hover:text-gold transition-colors underline underline-offset-8 decoration-warm-accent/30">Member Access</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

            <!-- Artistic Visual (Asymmetric) -->
            <div class="md:col-span-5 relative reveal">
                <div class="relative z-10 aspect-[4/5] bg-deep-black rounded-[45%] overflow-hidden border border-muted-text/10 shadow-2xl group">
                    <img src="https://picsum.photos/id/152/800/1000"
                         alt="Dark Botanical"
                         class="w-full h-full object-cover grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-[1.2s] ease-out">

                    <!-- Decorative Gold Frame Overlay -->
                    <div class="absolute inset-4 border border-gold/20 rounded-[45%] pointer-events-none"></div>
                </div>

                <!-- Abstract Background Shapes -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-terracotta/5 blur-[100px] rounded-full"></div>
                <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-soft-pink/10 blur-[80px] rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Quick Feature Teaser -->
    <section class="py-24 px-6 max-w-[1280px] mx-auto border-t border-muted-text/5">
        <div class="flex flex-col md:flex-row justify-between items-end gap-8 reveal">
            <h2 class="font-display text-3xl italic text-gold max-w-[10ch]">Hand-forged Excellence</h2>
            <div class="font-mono text-[10px] text-muted-text uppercase tracking-tighter">
                [ Collection_01 // Year_2026 ]
            </div>
        </div>
    </section>
@endsection
