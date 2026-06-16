@extends('layouts.app')

@section('content')
    <div class="pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <header class="mb-24 reveal text-center">
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">The Archive</span>
            <h1 class="font-display text-6xl italic">The Collections</h1>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @foreach($collections as $name => $items)
                <div class="group reveal relative overflow-hidden rounded-[40%] aspect-video">
                    <img src="{{ $items->first()->image_url }}" class="w-full h-full object-cover grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-deep-black/90 via-deep-black/20 to-transparent p-12 flex flex-col justify-end">
                        <h2 class="font-display text-4xl text-warm-text mb-4">{{ $name }}</h2>
                        <p class="font-body text-lg text-muted-text mb-8 max-w-sm">Experience the transformative power of {{ $name }} with our curated products.</p>
                        <a href="{{ route('shop', ['collection' => $name]) }}" class="font-accent text-[10px] uppercase tracking-widest text-gold border-b border-gold/30 pb-1 self-start hover:border-gold transition-all">Explore Collection</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
