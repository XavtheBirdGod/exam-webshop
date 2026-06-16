@extends('layouts.app')

@section('content')
<section class="pt-40 pb-32 px-6 max-w-[1440px] mx-auto min-h-screen">
    <div class="max-w-4xl mx-auto text-center">
        <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">Customer Care</span>
        <h1 class="font-display text-6xl md:text-7xl italic mb-12 reveal">How can we help?</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
            <div class="p-10 bg-white/5 border border-white/5 rounded-3xl reveal hover:border-white/20 transition-all">
                <h3 class="font-display text-2xl mb-4">Phone</h3>
                <p class="font-body text-muted-text">+31 (0)20 123 4567</p>
            </div>
            <div class="p-10 bg-white/5 border border-white/5 rounded-3xl reveal hover:border-white/20 transition-all">
                <h3 class="font-display text-2xl mb-4">Email</h3>
                <p class="font-body text-muted-text italic">care@rituals.com</p>
            </div>
            <div class="p-10 bg-white/5 border border-white/5 rounded-3xl reveal hover:border-white/20 transition-all">
                <h3 class="font-display text-2xl mb-4">Chat</h3>
                <p class="font-body text-muted-text">Available 24/7</p>
            </div>
        </div>

        <form class="mt-20 space-y-8 max-w-2xl mx-auto text-left reveal">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <input type="text" placeholder="NAME" class="w-full bg-transparent border-b border-white/10 py-4 outline-none focus:border-gold transition-colors font-accent text-[10px] tracking-widest">
                <input type="email" placeholder="EMAIL" class="w-full bg-transparent border-b border-white/10 py-4 outline-none focus:border-gold transition-colors font-accent text-[10px] tracking-widest">
            </div>
            <textarea placeholder="YOUR MESSAGE" rows="5" class="w-full bg-transparent border-b border-white/10 py-4 outline-none focus:border-gold transition-colors font-accent text-[10px] tracking-widest resize-none"></textarea>
            <x-button size="lg" class="w-full">Send Message</x-button>
        </form>
    </div>
</section>
@endsection
