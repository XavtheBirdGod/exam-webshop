@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-40 px-6 max-w-[1440px] mx-auto pb-32">
        <header class="mb-16 reveal text-center">
            <span class="font-accent text-gold uppercase tracking-[0.4em] text-[10px] mb-6 block">Your Collection</span>
            <h1 class="font-display text-6xl italic">The Shopping Bag</h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Cart Items -->
            <div class="lg:col-span-8 space-y-8">
                @if(count($cart) > 0)
                    @foreach($cart as $id => $details)
                        @php
                            $productId = $details['product_id'] ?? explode('-', $id)[0];
                        @endphp
                        <div class="flex items-center gap-8 p-8 bg-white/5 border border-white/5 rounded-3xl reveal group hover:border-white/10 transition-all duration-500 cart-item" data-id="{{ $id }}">
                            <div class="w-32 aspect-[3/4] rounded-2xl overflow-hidden bg-[#161615]">
                                <a href="{{ route('product.detail', ['id' => $productId]) }}" class="block w-full h-full">
                                    <img src="{{ $details['img'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 hover:scale-110">
                                </a>
                            </div>
                            
                            <div class="flex-grow">
                                <span class="font-accent text-[10px] text-gold uppercase tracking-[0.3em] mb-2 block">{{ $details['collection'] }}</span>
                                <a href="{{ route('product.detail', ['id' => $productId]) }}" class="inline-block hover:text-gold transition-colors">
                                    <h3 class="font-display text-2xl text-warm-text mb-2">{{ $details['name'] }}</h3>
                                </a>
                                <span class="font-accent text-[9px] text-muted-text uppercase tracking-widest block mb-4 italic">{{ $details['size'] ?? 'Standard' }}</span>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center border border-white/10 rounded-full px-2 py-1 gap-4">
                                        <button class="qty-btn minus text-muted-text hover:text-gold p-1 transition-colors" data-action="minus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                        </button>
                                        <span class="font-mono text-sm text-warm-text quantity">{{ $details['quantity'] }}</span>
                                        <button class="qty-btn plus text-muted-text hover:text-gold p-1 transition-colors" data-action="plus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                        </button>
                                    </div>
                                    <div>
                                        <span class="font-mono text-sm text-muted-text block mb-1">{{ tenant('currency_symbol') ?? '€' }}{{ number_format($details['price'], 2) }}</span>
                                        <span class="font-accent text-[9px] text-muted-text/60 uppercase tracking-widest">{{ $details['max_stock'] ?? 'In' }} stock</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="font-mono text-lg text-warm-text mb-4">{{ tenant('currency_symbol') ?? '€' }}<span class="item-total">{{ number_format($details['price'] * $details['quantity'], 2) }}</span></p>
                                <form action="{{ route('cart.remove') }}" method="POST" class="remove-form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="font-accent text-[10px] text-muted-text hover:text-terracotta uppercase tracking-widest transition-colors">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div id="empty-cart-msg" class="text-center py-24 bg-white/5 border border-white/5 rounded-[40%] reveal">
                        <p class="font-body text-2xl text-muted-text mb-12 italic">Your bag is currently empty.</p>
                        <x-button href="{{ route('shop') }}" variant="outline">Continue Shopping</x-button>
                    </div>
                @endif
            </div>

            <!-- Summary -->
            <div id="cart-summary" class="lg:col-span-4 reveal {{ count($cart) === 0 ? 'hidden' : '' }}">
                <div class="sticky top-40 bg-white/5 border border-white/5 p-10 rounded-[40px]">
                    <h4 class="font-display text-3xl text-warm-text mb-8">Summary</h4>

                    <!-- Shipping Calculator -->
                    <div class="mb-10 pb-8 border-b border-white/5 space-y-6">
                        <div>
                            <label class="font-accent text-[10px] text-gold uppercase tracking-[0.3em] mb-4 block">Shipping Destination</label>
                            <select id="shipping-country" class="w-full bg-deep-black text-warm-text font-mono text-[10px] uppercase tracking-widest outline-none border border-white/5 rounded px-4 py-3 cursor-pointer focus:border-gold/50 transition-colors">
                                <option value="" disabled {{ !$shippingCountry ? 'selected' : '' }}>Select Country</option>
                                <option value="Netherlands" {{ $shippingCountry === 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                <option value="France" {{ $shippingCountry === 'France' ? 'selected' : '' }}>France</option>
                                <option value="United Kingdom" {{ $shippingCountry === 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="Germany" {{ $shippingCountry === 'Germany' ? 'selected' : '' }}>Germany</option>
                                <option value="Belgium" {{ $shippingCountry === 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                <option value="International" {{ $shippingCountry === 'International' ? 'selected' : '' }}>Other (International)</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-accent text-[10px] text-gold uppercase tracking-[0.3em] mb-4 block">Full Delivery Address</label>
                            <textarea id="shipping-address" rows="3" placeholder="Enter your full street address, city, and postal code..." class="w-full bg-deep-black text-warm-text font-mono text-[10px] uppercase tracking-widest outline-none border border-white/5 rounded px-4 py-3 focus:border-gold/50 transition-colors resize-none">{{ $shippingAddress }}</textarea>
                            @auth
                                <p class="mt-2 font-mono text-[8px] text-muted-text/60 uppercase tracking-widest italic text-right">Will be saved to your profile</p>
                            @else
                                <p class="mt-2 font-mono text-[8px] text-muted-text/60 uppercase tracking-widest italic text-right"><a href="{{ route('login') }}" class="text-gold hover:underline">Login</a> to save for next time</p>
                            @endauth
                        </div>
                        
                        <p class="font-body text-[10px] text-muted-text italic">Costs are calculated based on your shop's location ({{ ucfirst(tenant('id')) }}) and destination.</p>
                    </div>

                    <div class="space-y-6 mb-10 border-b border-white/5 pb-10">
                        <div class="flex justify-between font-body text-lg">
                            <span class="text-muted-text">Subtotal</span>
                            <span class="text-warm-text">{{ tenant('currency_symbol') ?? '€' }}<span id="cart-subtotal">{{ number_format($total, 2) }}</span></span>
                        </div>
                        <div class="flex justify-between font-body text-lg">
                            <span class="text-muted-text">Shipping</span>
                            <span class="text-warm-text" id="shipping-cost-display">{{ tenant('currency_symbol') ?? '€' }}{{ number_format($shippingCost, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end mb-12">
                        <span class="font-accent text-[10px] text-gold uppercase tracking-[0.3em]">Total</span>
                        <span class="font-display text-4xl text-warm-text">{{ tenant('currency_symbol') ?? '€' }}<span id="cart-total">{{ number_format($grandTotal, 2) }}</span></span>
                    </div>

                    <div id="checkout-section">
                        <x-button id="checkout-button" size="lg" class="w-full mb-6">Proceed to Checkout</x-button>
                    </div>

                    <div id="payment-section" class="hidden">
                        <form id="payment-form" class="space-y-6">
                            <div id="payment-element">
                                <!-- Stripe.js injects the Payment Element here -->
                            </div>
                            <x-button id="submit-payment" size="lg" class="w-full">Pay Now</x-button>
                            <div id="payment-message" class="hidden text-terracotta font-mono text-[10px] uppercase tracking-widest text-center"></div>
                        </form>
                    </div>

                    <p class="text-center font-mono text-[9px] text-muted-text uppercase tracking-widest italic">Secure Payment & Conscious Delivery</p>
                </div>            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stripe = Stripe('{{ env("STRIPE_KEY") }}');
            let elements;

            const checkoutButton = document.getElementById('checkout-button');
            const checkoutSection = document.getElementById('checkout-section');
            const paymentSection = document.getElementById('payment-section');
            const paymentForm = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit-payment');
            const messageContainer = document.getElementById('payment-message');

            checkoutButton.addEventListener('click', async () => {
                const country = shippingSelector.value;
                const address = document.getElementById('shipping-address').value.trim();

                if (!country || address.length < 10) {
                    showToast('Please provide a valid country and full delivery address (min 10 characters).', 'error');
                    return;
                }

                // Save address before proceeding
                try {
                    await fetch('{{ route("cart.address.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ address: address })
                    });
                } catch (e) {
                    console.error('Error saving address:', e);
                }

                checkoutButton.disabled = true;
                checkoutButton.innerText = 'Initializing...';

                try {
                    const response = await fetch('{{ route("checkout.payment-intent") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const { clientSecret, error } = await response.json();

                    if (error) {
                        showToast(error, 'error');
                        checkoutButton.disabled = false;
                        checkoutButton.innerText = 'Proceed to Checkout';
                        return;
                    }

                    checkoutSection.classList.add('hidden');
                    paymentSection.classList.remove('hidden');

                    const appearance = { 
                        theme: 'night',
                        variables: {
                            colorPrimary: '#d4a574',
                            colorBackground: '#161615',
                            colorText: '#e8e4df',
                            colorDanger: '#c4856a',
                            fontFamily: 'Cormorant Garamond, serif',
                            spacingUnit: '4px',
                            borderRadius: '8px',
                        }
                    };
                    elements = stripe.elements({ appearance, clientSecret });

                    const paymentElementOptions = {
                        layout: "tabs",
                    };

                    const paymentElement = elements.create("payment", paymentElementOptions);
                    paymentElement.mount("#payment-element");

                } catch (e) {
                    console.error(e);
                    showToast('Could not initialize payment.', 'error');
                    checkoutButton.disabled = false;
                    checkoutButton.innerText = 'Proceed to Checkout';
                }
            });

            paymentForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                setLoading(true);

                const { error } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{ route('checkout.success') }}",
                    },
                });

                if (error.type === "card_error" || error.type === "validation_error") {
                    showMessage(error.message);
                } else {
                    showMessage("An unexpected error occurred.");
                }

                setLoading(false);
            });

            function showMessage(messageText) {
                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;

                setTimeout(function () {
                    messageContainer.classList.add("hidden");
                    messageText.textContent = "";
                }, 4000);
            }

            function setLoading(isLoading) {
                if (isLoading) {
                    submitButton.disabled = true;
                    submitButton.innerText = "Processing...";
                } else {
                    submitButton.disabled = false;
                    submitButton.innerText = "Pay Now";
                }
            }

            const shippingSelector = document.getElementById('shipping-country');
            const shippingDisplay = document.getElementById('shipping-cost-display');
            const totalDisplay = document.getElementById('cart-total');
            const symbol = '{{ tenant("currency_symbol") ?? "€" }}';

            shippingSelector.addEventListener('change', async () => {
                const country = shippingSelector.value;
                
                try {
                    const response = await fetch('{{ route("cart.shipping.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ country: country })
                    });

                    const data = await response.json();

                    if (data.success) {
                        shippingDisplay.innerText = symbol + data.shipping_cost;
                        totalDisplay.innerText = data.grand_total;
                        showToast('Shipping updated for ' + country);
                    }
                } catch (error) {
                    console.error('Error updating shipping:', error);
                }
            });

            // Update Quantity Logic
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach(item => {
                const id = item.getAttribute('data-id');
                const qtyBtns = item.querySelectorAll('.qty-btn');
                const qtySpan = item.querySelector('.quantity');
                const itemTotalSpan = item.querySelector('.item-total');

                qtyBtns.forEach(btn => {
                    btn.addEventListener('click', async () => {
                        let currentQty = parseInt(qtySpan.innerText);
                        const action = btn.getAttribute('data-action');

                        if (action === 'plus') {
                            currentQty++;
                        } else if (action === 'minus' && currentQty > 1) {
                            currentQty--;
                        } else {
                            return;
                        }

                        try {
                            const response = await fetch('{{ route("cart.update") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({ id: id, quantity: currentQty })
                            });

                            const data = await response.json();

                            if (response.ok && data.success) {
                                qtySpan.innerText = currentQty;
                                itemTotalSpan.innerText = data.item_total;
                                document.getElementById('cart-subtotal').innerText = data.subtotal;
                                
                                // Recalculate total with current shipping
                                const currentShipping = parseFloat(shippingDisplay.innerText.replace(symbol, '')) || 0;
                                const subtotal = parseFloat(data.subtotal.replace(',', ''));
                                totalDisplay.innerText = (subtotal + currentShipping).toLocaleString('en-IE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                                const countEl = document.getElementById('cart-count');
                                if (countEl) {
                                    countEl.innerText = data.cart_count;
                                    gsap.fromTo(countEl, { scale: 1.5 }, { scale: 1, duration: 0.5, ease: "back.out" });
                                }
                            } else {
                                showToast(data.message || 'Could not update quantity.', 'error');
                            }
                        } catch (error) {
                            console.error('Error updating cart:', error);
                        }
                    });
                });
            });

            // Remove Item Logic
            document.addEventListener('submit', async (e) => {
                if (e.target.classList.contains('remove-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const itemRow = form.closest('.cart-item');
                    const formData = new FormData(form);

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            showToast(data.message);
                            
                            // Animate out
                            gsap.to(itemRow, {
                                opacity: 0,
                                x: 50,
                                duration: 0.5,
                                onComplete: () => {
                                    itemRow.remove();
                                    
                                    // Update summary
                                    document.getElementById('cart-subtotal').innerText = data.subtotal;
                                    
                                    // Recalculate total with current shipping
                                    const currentShipping = parseFloat(shippingDisplay.innerText.replace(symbol, '')) || 0;
                                    const subtotal = parseFloat(data.subtotal.replace(',', ''));
                                    totalDisplay.innerText = (subtotal + currentShipping).toLocaleString('en-IE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                    
                                    // Update Nav Count
                                    const countEl = document.getElementById('cart-count');
                                    if (countEl) {
                                        countEl.innerText = data.cart_count;
                                        gsap.fromTo(countEl, { scale: 1.5 }, { scale: 1, duration: 0.5, ease: "back.out" });
                                    }

                                    // Check if cart is now empty
                                    if (data.is_empty) {
                                        document.getElementById('cart-summary').classList.add('hidden');
                                        const container = itemRow.parentElement;
                                        const emptyMsg = document.createElement('div');
                                        emptyMsg.id = "empty-cart-msg";
                                        emptyMsg.className = "text-center py-24 bg-white/5 border border-white/5 rounded-[40%] reveal";
                                        emptyMsg.innerHTML = `
                                            <p class="font-body text-2xl text-muted-text mb-12 italic">Your bag is currently empty.</p>
                                            <a href="{{ route('shop') }}" class="inline-flex items-center justify-center font-accent uppercase tracking-[0.2em] transition-all duration-300 active:scale-[0.98] border border-warm-accent/30 text-warm-text hover:border-warm-accent rounded-full px-10 py-4 text-[11px] font-semibold">Continue Shopping</a>
                                        `;
                                        container.appendChild(emptyMsg);
                                        gsap.from(emptyMsg, { opacity: 0, y: 20, duration: 0.8 });
                                    }
                                }
                            });
                        }
                    } catch (error) {
                        console.error('Error removing item:', error);
                    }
                }
            });
        });
    </script>
@endsection
