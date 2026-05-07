@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center px-4 py-20">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <h1 class="font-display text-4xl md:text-5xl mb-4">Welcome Back</h1>
            <p class="font-body text-muted-text">Please enter your details to sign in.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block font-accent text-sm uppercase tracking-widest text-muted-text mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                @error('email')
                    <p class="mt-1 text-terracotta text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-accent text-sm uppercase tracking-widest text-muted-text mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full bg-white/5 border border-white/10 px-4 py-3 text-warm-text focus:outline-none focus:border-warm-accent/50 transition-colors font-body">
                @error('password')
                    <p class="mt-1 text-terracotta text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 bg-white/5 border-white/10 text-warm-accent rounded focus:ring-warm-accent/50">
                    <label for="remember" class="ml-2 font-body text-sm text-muted-text">Remember me</label>
                </div>
            </div>

            <button type="submit" class="w-full bg-warm-accent text-deep-black font-accent py-4 uppercase tracking-[0.2em] text-sm hover:bg-gold transition-colors duration-500">
                Sign In
            </button>
        </form>

        <div class="mt-10 text-center">
            <p class="font-body text-muted-text">
                Don't have an account? <a href="{{ route('register') }}" class="text-warm-accent hover:text-gold transition-colors">Sign up</a>
            </p>
        </div>
    </div>
</section>
@endsection
