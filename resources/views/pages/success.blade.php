@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="text-center max-w-xl reveal">
            <div class="mb-12 inline-flex items-center justify-center w-24 h-24 rounded-full bg-gold/10 text-gold">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block text-center">Payment Successful</span>
            <h1 class="font-display text-6xl italic mb-8">Thank You for Your Purchase</h1>
            <p class="font-body text-xl text-muted-text mb-12 leading-relaxed">
                Your order has been received and is now being processed. We've sent a confirmation email with all the details to your inbox.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <x-button href="{{ route('account', ['tab' => 'orders']) }}">View Order History</x-button>
                <x-button href="{{ route('shop') }}" variant="outline">Back to Shop</x-button>
            </div>
        </div>
    </div>
@endsection
