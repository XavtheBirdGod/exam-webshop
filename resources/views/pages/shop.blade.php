@extends('layouts.app')

@section('content')
    <div class="pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <!-- Header -->
        <header class="mb-24 reveal text-center max-w-[800px] mx-auto">
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">The Collections</span>
            <h1 class="font-display text-6xl italic mb-8">Find Your Ritual</h1>
            <p class="font-body text-lg text-muted-text mb-12">
                Discover our range of luxury home and body care products. Each collection is designed to help you find a moment of peace and balance in your busy life.
            </p>
        </header>

        <!-- Filters & Sorting -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-16 pb-8 border-b border-muted-text/10 reveal">
            <div class="flex flex-wrap justify-center gap-10 font-mono text-[10px] text-muted-text uppercase tracking-widest">
                <button class="text-warm-accent border-b border-warm-accent pb-1">All Rituals</button>
                <button class="hover:text-warm-text transition-colors">Body Care</button>
                <button class="hover:text-warm-text transition-colors">Home Ambiance</button>
                <button class="hover:text-warm-text transition-colors">Gift Sets</button>
                <button class="hover:text-warm-text transition-colors">Limited Edition</button>
            </div>
            <div class="flex items-center gap-4">
                <span class="font-mono text-[9px] text-muted-text uppercase">Sort By:</span>
                <select class="bg-transparent font-mono text-[10px] text-warm-text uppercase tracking-widest outline-none border-none cursor-pointer">
                    <option>Recommended</option>
                    <option>Newest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-20">
            @php
                $products = [
                    ['name' => 'Foaming Shower Gel', 'collection' => 'Ritual of Jing', 'price' => '9.90', 'img' => 'https://images.unsplash.com/photo-1616489953149-808607147983?q=80&w=600'],
                    ['name' => 'Scented Candle', 'collection' => 'Ritual of Sakura', 'price' => '24.90', 'img' => 'https://images.unsplash.com/photo-1602928294704-454bd1abccc1?q=80&w=600'],
                    ['name' => 'Body Scrub', 'collection' => 'Ritual of Ayurveda', 'price' => '16.50', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=600'],
                    ['name' => 'Hand Balm', 'collection' => 'Ritual of Karma', 'price' => '11.90', 'img' => 'https://images.unsplash.com/photo-1590439472304-4c39677450c1?q=80&w=600'],
                    ['name' => 'Fragrance Sticks', 'collection' => 'Ritual of Hammam', 'price' => '27.90', 'img' => 'https://images.unsplash.com/photo-1616489953149-808607147983?q=80&w=600'],
                    ['name' => 'Body Cream', 'collection' => 'Ritual of Mehr', 'price' => '18.90', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=600'],
                    ['name' => 'Hair & Body Mist', 'collection' => 'Ritual of Sakura', 'price' => '17.50', 'img' => 'https://images.unsplash.com/photo-1602928294704-454bd1abccc1?q=80&w=600'],
                    ['name' => 'Bath Foam', 'collection' => 'Ritual of Jing', 'price' => '14.90', 'img' => 'https://images.unsplash.com/photo-1590439472304-4c39677450c1?q=80&w=600'],
                ];
            @endphp

            @foreach($products as $product)
                <x-product-card
                    :name="$product['name']"
                    :collection="$product['collection']"
                    :price="$product['price']"
                    :img="$product['img']"
                />
            @endforeach
        </div>

        <!-- Load More -->
        <div class="mt-32 text-center reveal">
            <x-button variant="outline" size="lg">Discover More</x-button>
        </div>
    </div>
@endsection
