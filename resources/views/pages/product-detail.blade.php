@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <!-- Sensory Gallery -->
            <div class="lg:col-span-7 reveal">
                <div class="sticky top-40 space-y-8">
                    <div class="aspect-[4/5] rounded-[48%] overflow-hidden bg-[#161615] border border-muted-text/10 shadow-2xl group">
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000">
                    </div>
                    <div class="grid grid-cols-3 gap-6 px-12">
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Authentic</span>
                            <span class="font-bold text-xs">Rituals</span>
                        </div>
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Soulful</span>
                            <span class="font-bold text-xs">Living</span>
                        </div>
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Deep</span>
                            <span class="font-bold text-xs">Wellness</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Narrative -->
            <div class="lg:col-span-5 flex flex-col justify-center reveal">
                <nav class="font-mono text-[10px] text-muted-text uppercase tracking-[0.3em] mb-12">
                    Collections / {{ $product->category }} / {{ $product->collection }}
                </nav>

                <h1 class="font-display text-7xl mb-8 leading-tight">
                    {{ explode(' ', $product->name)[0] }} <br>
                    <span class="text-gold italic">{{ implode(' ', array_slice(explode(' ', $product->name), 1)) }}</span>
                </h1>

                <div class="flex items-center gap-6 mb-12">
                    <span id="base-price" data-price="{{ $product->price }}" class="font-mono text-2xl text-warm-text">{{ tenant('currency_symbol') ?? '€' }}{{ number_format($product->price, 2) }}</span>
                    <span class="h-px w-16 bg-gold/30"></span>
                    @if($product->variants->count() > 0)
                        <select id="variant-selector" name="variant_id" form="add-to-cart-form" class="bg-deep-black font-mono text-[10px] text-muted-text uppercase tracking-widest outline-none border border-muted-text/20 rounded px-4 py-2 cursor-pointer focus:border-gold/50 transition-colors">
                            @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}" data-additional="{{ $variant->additional_price }}">
                                    {{ $variant->value }} (+{{ tenant('currency_symbol') ?? '€' }}{{ number_format($variant->additional_price, 2) }})
                                </option>
                            @endforeach
                        </select>
                    @else
                        <span class="font-accent text-[10px] text-muted-text uppercase tracking-widest">Standard Size</span>
                    @endif
                </div>

                <p class="font-body text-xl text-muted-text mb-16 leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- CTA -->
                <div class="flex flex-col gap-6 mb-20">
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST" class="ajax-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <x-button type="submit" size="lg" class="w-full">Add to Cart</x-button>
                    </form>
                    <p class="text-center font-mono text-[9px] text-muted-text uppercase tracking-widest">Free shipping on orders over {{ tenant('currency_symbol') ?? '€' }}35</p>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const selector = document.getElementById('variant-selector');
                        const priceDisplay = document.getElementById('base-price');
                        const basePrice = parseFloat(priceDisplay.getAttribute('data-price'));
                        const symbol = '{{ tenant("currency_symbol") ?? "€" }}';

                        if (selector) {
                            selector.addEventListener('change', () => {
                                const selectedOption = selector.options[selector.selectedIndex];
                                const additional = parseFloat(selectedOption.getAttribute('data-additional') || 0);
                                const totalPrice = basePrice + additional;
                                priceDisplay.innerText = symbol + totalPrice.toLocaleString('en-IE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            });
                        }
                    });
                </script>

                <!-- Product Details Accordion-style -->
                <div class="space-y-12 border-t border-muted-text/10 pt-12">
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">The Collection</h4>
                        <p class="font-body text-base text-muted-text leading-relaxed">Part of {{ $product->collection }}. Designed to help you find a moment of peace and balance.</p>
                    </div>
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">The Ritual</h4>
                        <p class="font-body text-base text-muted-text leading-relaxed">Simply apply a small amount to your skin and let the transformative fragrance elevate your mood and soul.</p>
                    </div>
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">Stock Availability</h4>
                        <p class="font-mono text-[10px] text-muted-text/60 leading-relaxed uppercase">{{ $product->stock }} units currently available in this location.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Complete the Ritual Section -->
        <section class="mt-48">
            <div class="text-center mb-20 reveal">
                <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">The Collection</span>
                <h2 class="font-display text-5xl">Complete the Ritual</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-12">
                @foreach($relatedProducts as $related)
                    <x-product-card
                        :id="$related->id"
                        :name="$related->name"
                        :collection="$related->collection"
                        :price="$related->price"
                        :img="$related->image_url"
                    />
                @endforeach
            </div>
        </section>
    </div>
@endsection
