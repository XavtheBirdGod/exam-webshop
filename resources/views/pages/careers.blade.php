@extends('layouts.app')

@section('content')
<section class="pt-40 pb-32 px-6 max-w-[1440px] mx-auto min-h-screen">
    <div class="max-w-6xl mx-auto">
        <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">Join the Team</span>
        <h1 class="font-display text-6xl md:text-8xl italic mb-12 reveal">Begin your soulful career</h1>
        
        <p class="font-body text-xl text-muted-text max-w-2xl leading-relaxed mb-20 reveal">
            We are looking for passionate individuals who believe that happiness is found in the smallest of things. Explore our global opportunities.
        </p>

        <div class="space-y-4 reveal">
            @php
                $jobs = [
                    'retail-excellence-manager' => ['title' => 'Retail Excellence Manager', 'dept' => 'Retail', 'location' => 'Amsterdam, NL'],
                    'digital-experience-designer' => ['title' => 'Digital Experience Designer', 'dept' => 'E-Commerce', 'location' => 'Amsterdam, NL'],
                    'fragrance-specialist' => ['title' => 'Fragrance Specialist', 'dept' => 'Product Development', 'location' => 'Paris, FR'],
                    'sustainability-lead' => ['title' => 'Sustainability Lead', 'dept' => 'Corporate Social Responsibility', 'location' => 'London, UK'],
                ];
            @endphp
            @foreach($jobs as $slug => $job)
                <a href="{{ route('careers.show', ['slug' => $slug]) }}" class="group flex items-center justify-between p-8 border border-white/5 hover:border-gold/30 hover:bg-white/[0.02] transition-all cursor-pointer rounded-2xl">
                    <div>
                        <h3 class="font-display text-2xl group-hover:text-gold transition-colors">{{ $job['title'] }}</h3>
                        <p class="font-accent text-[10px] uppercase tracking-widest text-muted-text mt-2">{{ $job['location'] }} • {{ $job['dept'] }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted-text group-hover:text-gold transition-colors"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
