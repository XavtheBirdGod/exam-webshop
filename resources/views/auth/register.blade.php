@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center px-4 py-32">
    <div class="max-w-xl w-full">
        <div class="text-center mb-10">
            <h1 class="font-display text-4xl md:text-5xl mb-4">Begin Your Journey</h1>
            <p class="font-body text-muted-text italic">Create an account to join the My Rituals community.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                    @error('name')
                        <p class="mt-1 text-terracotta text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="md:col-span-2">
                    <label for="email" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                    @error('email')
                        <p class="mt-1 text-terracotta text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                    @error('password')
                        <p class="mt-1 text-terracotta text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Repeat Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                </div>

                <!-- Phone Number (Optional) -->
                <div>
                    <label for="phone_number" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Phone Number (Optional)</label>
                    <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}"
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                    @error('phone_number')
                        <p class="mt-1 text-terracotta text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Birthday (Optional) -->
                <div>
                    <label for="birthday" class="block font-accent text-[10px] uppercase tracking-widest text-muted-text mb-2">Birthday (Optional)</label>
                    <input id="birthday" type="date" name="birthday" value="{{ old('birthday') }}"
                        class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                    @error('birthday')
                        <p class="mt-1 text-terracotta text-xs">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-warm-accent text-deep-black font-accent py-4 uppercase tracking-[0.2em] text-sm hover:bg-gold transition-colors duration-500">
                    Create Account
                </button>
            </div>
        </form>

        <div class="mt-10 text-center">
            <p class="font-body text-muted-text">
                Already have an account? <a href="{{ route('login') }}" class="text-warm-accent hover:text-gold transition-colors">Sign in</a>
            </p>
        </div>
    </div>
</section>
@endsection
