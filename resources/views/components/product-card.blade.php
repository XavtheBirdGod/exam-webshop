@props(['name', 'collection', 'price', 'img'])

<div {{ $attributes->merge(['class' => 'group reveal']) }}>
    <a href="{{ route('product.detail', ['id' => 1]) }}" class="block mb-6 relative overflow-hidden rounded-[48%] bg-[#161615] border border-muted-text/10 aspect-[3/4]">
        <img src="{{ $img }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-110">
        
        <!-- Quick View Overlay -->
        <div class="absolute inset-0 bg-deep-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
            <span class="font-accent text-[10px] uppercase tracking-[0.4em] text-warm-text border-b border-warm-text pb-1">View Ritual</span>
        </div>
    </a>
    <div class="text-center">
        <span class="font-accent text-[10px] text-gold uppercase tracking-[0.3em] mb-3 block">{{ $collection }}</span>
        <h3 class="font-display text-2xl text-warm-text mb-3 transition-colors group-hover:text-gold">{{ $name }}</h3>
        <p class="font-mono text-sm text-muted-text">€{{ $price }}</p>
    </div>
</div>
