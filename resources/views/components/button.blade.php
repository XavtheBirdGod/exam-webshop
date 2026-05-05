@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = "inline-flex items-center justify-center font-accent uppercase tracking-[0.2em] transition-all duration-300 active:scale-[0.98]";
    
    $variants = [
        'primary' => 'bg-warm-accent text-deep-black hover:bg-gold rounded-full',
        'outline' => 'border border-warm-accent/30 text-warm-text hover:border-warm-accent rounded-full',
        'ghost' => 'text-muted-text hover:text-warm-text',
    ];

    $sizes = [
        'sm' => 'px-6 py-2 text-[10px]',
        'md' => 'px-10 py-4 text-[11px] font-semibold',
        'lg' => 'px-14 py-5 text-[12px] font-bold',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
