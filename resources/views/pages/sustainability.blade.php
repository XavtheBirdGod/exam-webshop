@extends('layouts.app')

@section('content')
    <div class="pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <header class="mb-24 reveal text-center max-w-[800px] mx-auto">
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">Our Commitment</span>
            <h1 class="font-display text-6xl italic mb-8">Sustainability at Heart</h1>
            <p class="font-body text-lg text-muted-text leading-relaxed">
                We believe that the beauty of our products should not come at the cost of our planet. Our mission is to create luxury that respects the earth.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center mb-32">
            <div class="reveal">
                <div class="aspect-[4/5] rounded-[48%] overflow-hidden border border-gold/10">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1200" class="w-full h-full object-cover grayscale opacity-80">
                </div>
            </div>
            <div class="reveal">
                <h2 class="font-display text-4xl mb-8">Clean & Conscious</h2>
                <p class="font-body text-lg text-muted-text mb-8 leading-relaxed">
                    By 2026, our goal is for all our formulas to be of at least 90% natural origin. We are continuously working to reduce our carbon footprint through refillable packaging and ethical sourcing.
                </p>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="font-display text-2xl text-gold italic">01.</span>
                        <div>
                            <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-2">Refill Revolution</h4>
                            <p class="font-body text-sm text-muted-text">Our refillable products help save up to 70% in CO2 emissions and 65% in energy.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="font-display text-2xl text-gold italic">02.</span>
                        <div>
                            <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-2">Certified B Corp</h4>
                            <p class="font-body text-sm text-muted-text">We meet the highest standards of social and environmental performance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="py-24 bg-deep-black text-center reveal">
            <h3 class="font-display text-4xl italic text-warm-text mb-12">"We are not here to be the best in the world, <br> but the best FOR the world."</h3>
            <x-button variant="outline">Read Our 2026 Report</x-button>
        </section>
    </div>
@endsection
