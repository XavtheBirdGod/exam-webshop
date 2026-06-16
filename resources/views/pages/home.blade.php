@extends('layouts.app')

@section('content')
    @if(isset($tenants))
        <!-- Central Store Selector -->
        <section class="min-h-[100dvh] flex flex-col items-center justify-center px-6 pt-24 pb-12 max-w-[1440px] mx-auto text-center">
            <span class="font-accent text-warm-accent uppercase tracking-[0.4em] text-[10px] mb-6 block reveal">The Art of Living</span>
            <h1 class="font-display font-bold text-6xl mb-12 reveal">Choose Your <br> <span class="italic font-normal text-gold">Location</span></h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-5xl">
                @foreach($tenants as $tenant)
                    <a href="http://{{ $tenant->domains->first()->domain }}:{{ request()->getPort() }}" class="group reveal p-8 md:p-12 rounded-[40%] border border-muted-text/10 bg-deep-black/50 hover:bg-deep-black hover:border-gold transition-all duration-700 flex flex-col items-center justify-center text-center">
                        <h2 class="font-display text-3xl md:text-4xl text-warm-text group-hover:text-gold transition-colors mb-4 uppercase break-words w-full">
                            {{ $tenant->id }}
                        </h2>
                        <span class="font-accent text-[10px] text-muted-text uppercase tracking-widest block">Explore Local Rituals</span>
                    </a>
                @endforeach
            </div>
        </section>
    @else
        <!-- Hero Section -->
        <section class="min-h-[100dvh] flex items-center px-6 pt-24 pb-12 max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-center w-full">
                <div class="md:col-span-7 z-10">
                    <span class="font-accent text-warm-accent uppercase tracking-[0.4em] text-[10px] mb-6 block reveal">The Art of Living</span>
                    <h1 class="hero-title font-display font-bold text-[clamp(3rem,10vw,6rem)] mb-10 reveal">
                        Your Path <br> <span class="italic font-normal text-gold">to Inner</span> <br> Balance
                    </h1>
                    <p class="font-body text-xl max-w-[40ch] text-muted-text mb-12 reveal leading-relaxed">
                        Transform your daily routines into meaningful rituals with our collection of luxury home and body products. Inspired by the wisdom of ancient traditions.
                    </p>
                    <div class="reveal">
                        <x-button href="{{ route('shop') }}" size="lg">Explore the Collections</x-button>
                    </div>
                </div>

                <!-- Asymmetric Image Composition -->
                <div class="md:col-span-5 relative reveal">
                    <div class="aspect-[4/5] bg-[#1a1a1a] rounded-[48%] overflow-hidden border border-muted-text/10 shadow-2xl relative group">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1200" alt="Jewelry" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 scale-110 group-hover:scale-100">
                        <div class="absolute inset-0 bg-deep-black/20 group-hover:bg-transparent transition-all duration-700"></div>
                    </div>
                    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-warm-accent/5 backdrop-blur-3xl rounded-full border border-warm-accent/10 -z-10 hidden md:block"></div>
                </div>
            </div>
        </section>

        <!-- The Ritual Philosophy -->
        <section class="py-32 px-6 bg-[#0a0a0a]">
            <div class="max-w-[1280px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-24 items-center">
                <div class="reveal">
                    <div class="aspect-square rounded-[50%] overflow-hidden border border-gold/10">
                        <img src="https://images.unsplash.com/photo-1552693673-1bf958298935?q=80&w=1000" class="w-full h-full object-cover opacity-80">
                    </div>
                </div>
                <div class="reveal">
                    <span class="font-accent text-gold uppercase tracking-[0.3em] text-[10px] mb-6 block">Our Philosophy</span>
                    <h2 class="font-display text-5xl mb-8 leading-tight">Small Moments, <br><span class="italic text-soft-pink">Great Memories</span></h2>
                    <p class="font-body text-lg text-muted-text mb-10 leading-relaxed">
                        At Rituals, we believe that happiness can be found in the smallest of things. It is our passion to turn your everyday routines into more meaningful rituals. Whether it's taking a long bath or creating a homey atmosphere with the rich scent of Asian incense.
                    </p>
                </div>
            </div>
        </section>

        <!-- Best Sellers (Visual Grid) -->
        <section class="py-32 px-6 max-w-[1440px] mx-auto">
            <div class="flex justify-between items-end mb-16 reveal">
                <div>
                    <span class="font-accent text-warm-accent uppercase tracking-[0.3em] text-[10px] mb-4 block">Essentials</span>
                    <h2 class="font-display text-4xl">The Beloved Rituals</h2>
                </div>
                <a href="/shop" class="font-accent text-[10px] uppercase tracking-widest text-muted-text hover:text-gold transition-colors border-b border-muted-text/20 pb-1">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $index => $product)
                    <x-product-card
                        :id="$product->id"
                        :name="$product->name"
                        :collection="$product->collection"
                        :price="$product->price"
                        :img="$product->image_url"
                    />
                @endforeach
            </div>
        </section>

        <!-- Editorial Quote -->
        <section class="py-48 px-6 bg-deep-black text-center reveal">
            <div class="max-w-[800px] mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-gold/30 mx-auto mb-12">
                    <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v3c0 1.25.75 2 2 2h3c0 4-2 6-2 6"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v3c0 1.25.75 2 2 2h3c0 4-2 6-2 6"/>
                </svg>
                <h3 class="font-display text-5xl italic text-warm-text mb-12 leading-tight">
                    "The ritual of doing nothing is as important as the ritual of doing everything."
                </h3>
                <span class="font-accent text-[10px] uppercase tracking-[0.4em] text-gold">Ancient Wisdom</span>
            </div>
        </section>
    @endif
@endsection
