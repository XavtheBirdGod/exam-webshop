@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <!-- Sensory Gallery -->
            <div class="lg:col-span-7 reveal">
                <div class="sticky top-40 space-y-8">
                    <div class="aspect-[4/5] rounded-[48%] overflow-hidden bg-[#161615] border border-muted-text/10 shadow-2xl group">
                        <img src="https://images.unsplash.com/photo-1616489953149-808607147983?q=80&w=1200" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000">
                    </div>
                    <div class="grid grid-cols-3 gap-6 px-12">
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Scented</span>
                            <span class="font-bold text-xs">Bamboo</span>
                        </div>
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Soulful</span>
                            <span class="font-bold text-xs">Living</span>
                        </div>
                        <div class="aspect-square rounded-full border border-gold/20 flex flex-col items-center justify-center italic font-display text-gold text-[10px] text-center p-4">
                            <span class="block mb-1">Deep</span>
                            <span class="font-bold text-xs">Relaxation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Narrative -->
            <div class="lg:col-span-5 flex flex-col justify-center reveal">
                <nav class="font-mono text-[10px] text-muted-text uppercase tracking-[0.3em] mb-12">
                    Collections / Body / The Ritual of Jing
                </nav>

                <h1 class="font-display text-7xl mb-8 leading-tight">Sleep Foaming <br><span class="text-gold italic">Shower Gel</span></h1>

                <div class="flex items-center gap-6 mb-12">
                    <span class="font-mono text-2xl text-warm-text">€9.90</span>
                    <span class="h-px w-16 bg-gold/30"></span>
                    <span class="font-accent text-[10px] text-muted-text uppercase tracking-widest">200ml / 6.7 fl.oz.</span>
                </div>

                <p class="font-body text-xl text-muted-text mb-16 leading-relaxed">
                    Transform your shower into a meaningful ceremony. This foaming shower gel combines the calming scent of Sacred Lotus and Jujube to help you find inner peace and prepare for a restful sleep.
                </p>

                <!-- CTA -->
                <div class="flex flex-col gap-6 mb-20">
                    <x-button size="lg">Add to Cart</x-button>
                    <p class="text-center font-mono text-[9px] text-muted-text uppercase tracking-widest">Free shipping on orders over €35</p>
                </div>

                <!-- Product Details Accordion-style -->
                <div class="space-y-12 border-t border-muted-text/10 pt-12">
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">The Scent Profile</h4>
                        <p class="font-body text-base text-muted-text leading-relaxed">A complex blend of Sacred Lotus—symbol of purity—and Jujube seeds, traditionally used in Chinese medicine to reduce stress and produce a calm state of mind.</p>
                    </div>
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">The Ritual</h4>
                        <p class="font-body text-base text-muted-text leading-relaxed">Simply squeeze a small amount into your hand and watch the gel transform into a rich, noble foam. Close your eyes and breathe in the aroma.</p>
                    </div>
                    <div>
                        <h4 class="font-accent text-[11px] text-gold uppercase tracking-[0.3em] mb-6">Ingredients</h4>
                        <p class="font-mono text-[10px] text-muted-text/60 leading-relaxed uppercase">Aqua/Water, Sodium Laureth Sulfate, Cocamidopropyl Betaine, Isopentane, Sorbitol, Isopropyl Palmitate, Parfum/Fragrance, Isobutane, Lotus Flower Extract, Jujube Seed Extract...</p>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <x-product-card
                    name="Body Cream"
                    collection="Ritual of Jing"
                    price="18.90"
                    img="https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=600"
                />
                <x-product-card
                    name="Scented Candle"
                    collection="Ritual of Jing"
                    price="24.90"
                    img="https://images.unsplash.com/photo-1602928294704-454bd1abccc1?q=80&w=600"
                    class="mt-12"
                />
                <x-product-card
                    name="Pillow Mist"
                    collection="Ritual of Jing"
                    price="17.50"
                    img="https://images.unsplash.com/photo-1590439472304-4c39677450c1?q=80&w=600"
                />
            </div>
        </section>
    </div>
@endsection
