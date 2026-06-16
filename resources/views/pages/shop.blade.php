@extends('layouts.app')

@section('content')
    <div class="pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <!-- Header -->
        <header class="mb-24 reveal text-center max-w-[800px] mx-auto">
            @if(request('query'))
                <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">
                    Search Results for
                </span>
                <h1 class="font-display text-6xl italic mb-8">"{{ request('query') }}"</h1>
                <p class="font-body text-lg text-muted-text mb-12">
                    Showing results for your search. If you can't find what you're looking for, try browsing our curated collections below.
                </p>
            @else
                <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">
                    The {{ tenant('city') ?? '' }} Collections
                </span>
                <h1 class="font-display text-6xl italic mb-8">Find Your Ritual</h1>
                <p class="font-body text-lg text-muted-text mb-12">
                    Discover our range of luxury home and body care products, curated specifically for our {{ tenant('city') ?? 'global' }} flagship. Each collection is designed to help you find a moment of peace and balance in your busy life.
                </p>
            @endif
        </header>

        <!-- Filters & Sorting -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-16 pb-8 border-b border-muted-text/10 reveal">
            <div id="category-filters" class="flex flex-wrap justify-center gap-10 font-mono text-[10px] uppercase tracking-widest">
                <a href="{{ route('shop', request()->only(['sort', 'query'])) }}" 
                   data-category=""
                   class="category-link {{ !request('category') ? 'text-warm-accent border-b border-warm-accent pb-1' : 'text-muted-text hover:text-warm-text transition-colors' }}">
                   All Rituals
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('shop', array_merge(request()->only(['sort', 'query']), ['category' => $category])) }}" 
                       data-category="{{ $category }}"
                       class="category-link {{ request('category') == $category ? 'text-warm-accent border-b border-warm-accent pb-1' : 'text-muted-text hover:text-warm-text transition-colors' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
            <div class="flex items-center gap-4">
                <span class="font-mono text-[9px] text-muted-text uppercase">Sort By:</span>
                <select id="sort-select" 
                        class="bg-deep-black text-warm-text font-mono text-[10px] uppercase tracking-widest outline-none border border-white/5 rounded px-2 py-1 cursor-pointer focus:border-gold/50 transition-colors">
                    <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </div>

        <!-- Product Grid -->
        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-20">
            @include('pages.shop-products', ['products' => $products])
        </div>

        <!-- Load More -->
        <div class="mt-32 text-center reveal">
            <x-button variant="outline" size="lg">Discover More</x-button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productGrid = document.getElementById('product-grid');
            const categoryLinks = document.querySelectorAll('.category-link');
            const sortSelect = document.getElementById('sort-select');

            function fetchProducts(url) {
                // Show loading state if desired
                productGrid.style.opacity = '0.5';

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    productGrid.innerHTML = html;
                    productGrid.style.opacity = '1';
                    
                    // Re-run animations for new items if they use GSAP
                    if (window.gsap) {
                        const newItems = productGrid.querySelectorAll('.reveal');
                        gsap.fromTo(newItems, 
                            { opacity: 0, y: 20 },
                            { opacity: 1, y: 0, duration: 0.6, stagger: 0.1 }
                        );
                    }
                })
                .catch(error => console.error('Error fetching products:', error));
            }

            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    
                    // Update active class
                    categoryLinks.forEach(l => {
                        l.classList.remove('text-warm-accent', 'border-b', 'border-warm-accent', 'pb-1');
                        l.classList.add('text-muted-text', 'hover:text-warm-text', 'transition-colors');
                    });
                    this.classList.add('text-warm-accent', 'border-b', 'border-warm-accent', 'pb-1');
                    this.classList.remove('text-muted-text', 'hover:text-warm-text', 'transition-colors');

                    history.pushState(null, '', url);
                    fetchProducts(url);
                });
            });

            sortSelect.addEventListener('change', function() {
                const sortValue = this.value;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('sort', sortValue);
                
                const url = currentUrl.toString();
                history.pushState(null, '', url);
                fetchProducts(url);
            });

            window.addEventListener('popstate', function() {
                fetchProducts(window.location.href);
                // Update active category link based on URL
                const params = new URLSearchParams(window.location.search);
                const category = params.get('category') || '';
                
                categoryLinks.forEach(l => {
                    const lCategory = l.getAttribute('data-category') || '';
                    if (lCategory === category) {
                        l.classList.add('text-warm-accent', 'border-b', 'border-warm-accent', 'pb-1');
                        l.classList.remove('text-muted-text', 'hover:text-warm-text', 'transition-colors');
                    } else {
                        l.classList.remove('text-warm-accent', 'border-b', 'border-warm-accent', 'pb-1');
                        l.classList.add('text-muted-text', 'hover:text-warm-text', 'transition-colors');
                    }
                });

                // Update sort select
                sortSelect.value = params.get('sort') || 'recommended';
            });
        });
    </script>
@endsection
