@extends('layouts.app')

@section('content')
    <div class="pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <header class="mb-24 reveal text-center">
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">The Archive</span>
            <h1 class="font-display text-6xl italic">The Collections</h1>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @php
                $collections = [
                    ['name' => 'The Ritual of Sakura', 'desc' => 'Celebrate each day as a new beginning.', 'img' => 'https://images.unsplash.com/photo-1602928294704-454bd1abccc1?q=80&w=1200'],
                    ['name' => 'The Ritual of Jing', 'desc' => 'Your path to inner peace.', 'img' => 'https://images.unsplash.com/photo-1616489953149-808607147983?q=80&w=1200'],
                    ['name' => 'The Ritual of Ayurveda', 'desc' => 'Balance of body, mind and soul.', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=1200'],
                    ['name' => 'The Ritual of Hammam', 'desc' => 'A purifying ceremony for body and soul.', 'img' => 'https://images.unsplash.com/photo-1590439472304-4c39677450c1?q=80&w=1200'],
                ];
            @endphp

            @foreach($collections as $collection)
                <div class="group reveal relative overflow-hidden rounded-[40%] aspect-video">
                    <img src="{{ $collection['img'] }}" class="w-full h-full object-cover grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-deep-black/90 via-deep-black/20 to-transparent p-12 flex flex-col justify-end">
                        <h2 class="font-display text-4xl text-warm-text mb-4">{{ $collection['name'] }}</h2>
                        <p class="font-body text-lg text-muted-text mb-8 max-w-sm">{{ $collection['desc'] }}</p>
                        <a href="{{ route('shop') }}" class="font-accent text-[10px] uppercase tracking-widest text-gold border-b border-gold/30 pb-1 self-start hover:border-gold transition-all">Explore Collection</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
