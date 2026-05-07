@extends('layouts.app')

@section('content')
<section class="pt-32 pb-20 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-20">
            <h1 class="font-display text-5xl md:text-7xl mb-6 tracking-tight">My Rituals</h1>
            <p class="font-body text-xl text-muted-text max-w-2xl mx-auto italic">
                Welcome, {{ auth()->user()->name }}. Your journey to soulful living continues here.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12" x-data="{ activeTab: 'status' }">
            <!-- Sidebar / Status -->
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white/5 border border-white/10 p-10 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold/10 blur-3xl -mr-16 -mt-16 group-hover:bg-gold/20 transition-colors duration-700"></div>
                    
                    <p class="font-accent text-xs uppercase tracking-[0.3em] text-muted-text mb-4">Current Status</p>
                    <h2 class="font-display text-4xl text-gold mb-2">Soulmate</h2>
                    <p class="font-accent text-[10px] uppercase tracking-[0.2em] text-muted-text mb-8">Level {{ auth()->user()->soulmate_level }}</p>
                    
                    <div class="space-y-6">
                        @if(auth()->user()->soulmate_level < 3)
                            <div class="relative h-1 bg-white/10 w-full overflow-hidden">
                                <div class="absolute left-0 top-0 h-full bg-gold transition-all duration-1000" style="width: {{ (auth()->user()->soulmate_level / 3) * 100 }}%"></div>
                            </div>
                            <p class="font-body text-sm text-muted-text">
                                You're making progress towards <span class="text-warm-text">Level {{ auth()->user()->soulmate_level + 1 }} Soulmate</span> status.
                            </p>
                        @else
                            <div class="relative h-1 bg-gold w-full"></div>
                            <p class="font-body text-sm text-gold">
                                You have reached the <span class="text-warm-text italic">Ultimate Soulmate</span> status.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                    <button @click="activeTab = 'status'" :class="activeTab === 'status' ? 'border-gold/50 bg-white/[0.02]' : 'border-white/5'" class="w-full text-left p-6 border hover:border-gold/30 transition-all duration-300 group">
                        <p class="font-accent text-[10px] uppercase tracking-[0.2em]" :class="activeTab === 'status' ? 'text-gold' : 'text-muted-text'">Member Status</p>
                    </button>
                    <button @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-gold/50 bg-white/[0.02]' : 'border-white/5'" class="w-full text-left p-6 border hover:border-gold/30 transition-all duration-300 group">
                        <p class="font-accent text-[10px] uppercase tracking-[0.2em]" :class="activeTab === 'details' ? 'text-gold' : 'text-muted-text'">Personal Details</p>
                    </button>
                    <button @click="activeTab = 'orders'" :class="activeTab === 'orders' ? 'border-gold/50 bg-white/[0.02]' : 'border-white/5'" class="w-full text-left p-6 border hover:border-gold/30 transition-all duration-300 group">
                        <p class="font-accent text-[10px] uppercase tracking-[0.2em]" :class="activeTab === 'orders' ? 'text-gold' : 'text-muted-text'">Order History</p>
                    </button>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <!-- Tab: Status & Benefits -->
                <div x-show="activeTab === 'status'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                    <div>
                        <h3 class="font-display text-3xl mb-8">Your Soulmate Benefits</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Benefits (Level 1+) -->
                            <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12V8H4v4"/><path d="M2 12h20"/><path d="M7 12v10"/><path d="M17 12v10"/><path d="M2 22h20"/><path d="M12 2v6"/><path d="m12 8 4-4"/><path d="m12 8-4-4"/></svg>
                                </div>
                                <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Welcome Gift</h4>
                                <p class="font-body text-sm text-muted-text leading-relaxed">
                                    A special "Thank You" gift awaits you with your second purchase.
                                </p>
                            </div>

                            <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                </div>
                                <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Monthly Gift</h4>
                                <p class="font-body text-sm text-muted-text leading-relaxed">
                                    Receive a complimentary gift with any purchase over €50.
                                </p>
                            </div>

                            @if(auth()->user()->soulmate_level >= 2)
                                <!-- Level 2 Benefits -->
                                <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                    <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                                    </div>
                                    <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Early Access</h4>
                                    <p class="font-body text-sm text-muted-text leading-relaxed">
                                        Be the first to explore new collections and seasonal sales.
                                    </p>
                                </div>

                                <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                    <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                    </div>
                                    <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Expert Workshops</h4>
                                    <p class="font-body text-sm text-muted-text leading-relaxed">
                                        Exclusive invitations to workshops led by our wellness experts.
                                    </p>
                                </div>
                            @endif

                            @if(auth()->user()->soulmate_level >= 3)
                                <!-- Level 3 Benefits -->
                                <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                    <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/><path d="M17 15v7"/></svg>
                                    </div>
                                    <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Refill Reward</h4>
                                    <p class="font-body text-sm text-muted-text leading-relaxed">
                                        Enjoy a permanent 10% discount on all product refills.
                                    </p>
                                </div>

                                <div class="border border-white/10 p-8 hover:bg-white/[0.02] transition-colors">
                                    <div class="w-12 h-12 border border-gold/30 flex items-center justify-center mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9b896" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
                                    </div>
                                    <h4 class="font-accent text-xs uppercase tracking-widest text-warm-text mb-3">Mind Oasis</h4>
                                    <p class="font-body text-sm text-muted-text leading-relaxed">
                                        10% discount on all treatments at our Mind Oasis locations.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(auth()->user()->soulmate_level < 3)
                        <div class="bg-gold/5 border border-gold/10 p-10">
                            <h3 class="font-display text-2xl mb-6 text-gold">Unlock Level {{ auth()->user()->soulmate_level + 1 }} Benefits</h3>
                            <ul class="space-y-4">
                                @if(auth()->user()->soulmate_level == 1)
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">Premium Birthday Gift</p>
                                    </li>
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">Early Access to Sales & New Collections</p>
                                    </li>
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">Exclusive Invites to Expert Workshops</p>
                                    </li>
                                @elseif(auth()->user()->soulmate_level == 2)
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">Deluxe Birthday Gift</p>
                                    </li>
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">10% Off Product Refills</p>
                                    </li>
                                    <li class="flex items-center gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gold"></div>
                                        <p class="font-body text-muted-text italic">10% Off Mind Oasis Treatments</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @else
                        <div class="bg-gold/10 border border-gold/30 p-10 text-center">
                            <h3 class="font-display text-2xl mb-4 text-gold">The Ultimate Journey</h3>
                            <p class="font-body text-muted-text italic max-w-md mx-auto">
                                You have unlocked the full potential of My Rituals. Enjoy your exclusive Soulmate benefits and the path to soulful living.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Tab: Personal Details -->
                <div x-show="activeTab === 'details'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                    <h3 class="font-display text-3xl mb-8">Personal Details</h3>
                    
                    @if (session('status') === 'profile-updated')
                        <div class="bg-gold/10 border border-gold/30 p-4 mb-8">
                            <p class="font-accent text-[10px] uppercase tracking-widest text-gold text-center">Profile updated successfully.</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="name" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-3">Full Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                    class="w-full bg-white/5 border border-white/10 px-4 py-4 text-warm-text focus:outline-none focus:border-gold/50 transition-colors font-body">
                                @error('name')
                                    <p class="mt-2 text-terracotta text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone_number" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-3">Phone Number</label>
                                <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                    class="w-full bg-white/5 border border-white/10 px-4 py-4 text-warm-text focus:outline-none focus:border-gold/50 transition-colors font-body">
                                @error('phone_number')
                                    <p class="mt-2 text-terracotta text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="birthday" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-3">Birthday</label>
                                <input id="birthday" type="date" name="birthday" value="{{ old('birthday', auth()->user()->birthday) }}"
                                    class="w-full bg-white/5 border border-white/10 px-4 py-4 text-warm-text focus:outline-none focus:border-gold/50 transition-colors font-body">
                                @error('birthday')
                                    <p class="mt-2 text-terracotta text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-3">Shipping Address</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3"
                                    class="w-full bg-white/5 border border-white/10 px-4 py-4 text-warm-text focus:outline-none focus:border-gold/50 transition-colors font-body">{{ old('shipping_address', auth()->user()->shipping_address) }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-2 text-terracotta text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-warm-accent text-deep-black font-accent py-4 px-12 uppercase tracking-[0.2em] text-[10px] hover:bg-gold transition-colors duration-500">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab: Order History -->
                <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                    <h3 class="font-display text-3xl mb-8">Order History</h3>

                    @if($orders->isEmpty())
                        <div class="border border-white/5 p-20 text-center">
                            <p class="font-body text-muted-text italic">Your journey of purchases has not yet begun.</p>
                            <a href="{{ route('shop') }}" class="inline-block mt-8 font-accent text-[10px] uppercase tracking-widest text-gold hover:text-warm-text transition-colors border-b border-gold/30 pb-1">Start Shopping</a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-white/10 overflow-hidden group">
                                    <div class="bg-white/[0.02] p-6 flex flex-wrap justify-between items-center gap-4 border-b border-white/5">
                                        <div class="flex gap-8">
                                            <div>
                                                <p class="font-accent text-[8px] uppercase tracking-widest text-muted-text mb-1">Order Date</p>
                                                <p class="font-accent text-[10px] text-warm-text">{{ $order->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="font-accent text-[8px] uppercase tracking-widest text-muted-text mb-1">Order Number</p>
                                                <p class="font-accent text-[10px] text-warm-text">{{ $order->order_number }}</p>
                                            </div>
                                            <div>
                                                <p class="font-accent text-[8px] uppercase tracking-widest text-muted-text mb-1">Total</p>
                                                <p class="font-accent text-[10px] text-gold">€{{ number_format($order->total_amount, 2) }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="px-3 py-1 border border-gold/30 text-gold font-accent text-[8px] uppercase tracking-widest">
                                                {{ $order->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="space-y-4">
                                            @foreach($order->items as $item)
                                                <div class="flex justify-between items-center">
                                                    <div class="flex items-center gap-4">
                                                        <div class="w-12 h-12 bg-white/5 flex items-center justify-center border border-white/5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9a9590" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.2 7.8H3.8c-1.1 0-2 .9-2 2v10.4c0 1.1.9 2 2 2h16.4c1.1 0 2-.9 2-2V9.8c0-1.1-.9-2-2-2z"/><path d="M16.5 7.8V4.5c0-1.1-.9-2-2-2h-5c-1.1 0-2 .9-2 2v3.3"/></svg>
                                                        </div>
                                                        <div>
                                                            <p class="font-body text-sm text-warm-text">{{ $item->product->name }}</p>
                                                            <p class="font-accent text-[9px] text-muted-text uppercase tracking-widest">Qty: {{ $item->quantity }}</p>
                                                        </div>
                                                    </div>
                                                    <p class="font-accent text-[10px] text-warm-text">€{{ number_format($item->price, 2) }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
