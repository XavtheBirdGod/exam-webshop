@props(['id' => 1, 'name', 'collection', 'price', 'img'])

<div {{ $attributes->merge(['class' => 'group reveal']) }}>
    <div class="block mb-6 relative overflow-hidden rounded-[48%] bg-[#161615] border border-muted-text/10 aspect-[3/4]">
        <a href="{{ route('product.detail', ['id' => $id]) }}">
            <img src="{{ $img }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-110">
        </a>
        
        <!-- Quick View & Add Overlay -->
        <div class="absolute inset-0 bg-deep-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col items-center justify-center gap-4">
            <a href="{{ route('product.detail', ['id' => $id]) }}" class="font-accent text-[10px] uppercase tracking-[0.4em] text-warm-text border-b border-warm-text pb-1 hover:text-gold hover:border-gold transition-colors">View Ritual</a>
            
            <form action="{{ route('cart.add') }}" method="POST" class="ajax-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <button type="submit" class="bg-warm-text text-deep-black px-6 py-2 rounded-full font-accent text-[9px] uppercase tracking-widest hover:bg-gold transition-colors">
                    Add to Bag
                </button>
            </form>
        </div>
    </div>
    <div class="text-center">
        <span class="font-accent text-[10px] text-gold uppercase tracking-[0.3em] mb-3 block">{{ $collection }}</span>
        <h3 class="font-display text-2xl text-warm-text mb-3 transition-colors group-hover:text-gold">{{ $name }}</h3>
        <p class="font-mono text-sm text-muted-text">€{{ $price }}</p>
    </div>
</div>
