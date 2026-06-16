@extends('layouts.app')

@section('content')
<section class="pt-40 pb-32 px-6 max-w-[1440px] mx-auto min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="mb-12">
            <a href="{{ route('careers') }}" class="font-accent text-[10px] uppercase tracking-[0.3em] text-muted-text hover:text-gold transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Careers
            </a>
        </div>

        <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">{{ $job['dept'] }}</span>
        <h1 class="font-display text-6xl md:text-8xl italic mb-6 reveal">{{ $job['title'] }}</h1>
        <p class="font-accent text-xs uppercase tracking-widest text-muted-text mb-16">{{ $job['location'] }} • Full-time</p>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16">
            <div class="md:col-span-8 space-y-16">
                <div class="reveal">
                    <h3 class="font-display text-3xl mb-8 italic">The Role</h3>
                    <div class="font-body text-lg text-muted-text leading-relaxed space-y-6">
                        <p>As a {{ $job['title'] }} at Rituals, you will be at the heart of our mission to turn everyday routines into meaningful rituals. You will lead initiatives that enhance our customer experience and drive excellence within the {{ $job['dept'] }} department.</p>
                        <p>We are looking for someone who combines professional expertise with a soulful mindset, ensuring that every touchpoint with our brand reflects our core values of joy and wellbeing.</p>
                    </div>
                </div>

                <div class="reveal">
                    <h3 class="font-display text-3xl mb-8 italic">Requirements</h3>
                    <ul class="space-y-4 font-body text-lg text-muted-text">
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>Minimum of 5 years experience in a similar role within premium retail or luxury goods.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>Strong analytical skills combined with a creative, problem-solving mindset.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>Excellent communication skills in English (both written and verbal).</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>A deep passion for the Rituals philosophy and wellness industry.</span>
                        </li>
                    </ul>
                </div>

                <div class="reveal">
                    <h3 class="font-display text-3xl mb-8 italic">What we offer</h3>
                    <ul class="space-y-4 font-body text-lg text-muted-text">
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>A vibrant, international working environment in the heart of {{ explode(',', $job['location'])[0] }}.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>Opportunities for personal and professional growth through our Academy.</span>
                        </li>
                        <li class="flex gap-4">
                            <span class="text-gold">•</span>
                            <span>A competitive salary and premium benefits package.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:col-span-4">
                <div class="sticky top-40 bg-white/5 border border-white/10 p-10 rounded-3xl reveal">
                    <h4 class="font-display text-2xl mb-6 italic">How to Apply</h4>
                    <p class="font-body text-sm text-muted-text mb-8 leading-relaxed">
                        If you are ready to begin your soulful journey with us, please send your CV and a brief motivation letter to our recruitment team.
                    </p>
                    <div class="space-y-6">
                        <div>
                            <p class="font-accent text-[8px] uppercase tracking-widest text-gold mb-1">Send your application to</p>
                            <p class="font-body text-sm text-warm-text">careers@rituals.com</p>
                        </div>
                        <div>
                            <p class="font-accent text-[8px] uppercase tracking-widest text-gold mb-1">Subject Line</p>
                            <p class="font-body text-sm text-warm-text italic">Application: {{ $job['title'] }}</p>
                        </div>
                    </div>
                    <x-button class="w-full mt-10" href="mailto:careers@rituals.com?subject=Application: {{ $job['title'] }}">Apply Now</x-button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
