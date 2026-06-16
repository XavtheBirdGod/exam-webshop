<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rituals | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Spectral:ital,wght@0,400;0,500;0,700;1,400&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rituals-gold': '#d4a574',
                        'rituals-red': '#c4856a', // terracotta from store
                        'rituals-bg': '#0f0f0f',
                        'rituals-surface': '#161615',
                        'rituals-surface-elevated': '#1c1c1b',
                        'rituals-border': 'rgba(255,255,255,0.05)',
                        'rituals-text': '#e8e4df',
                        'rituals-text-muted': '#9a9590',
                        'rituals-success': '#d4a574', // using gold as primary success accent or keeping a separate green if preferred
                    },
                    fontFamily: {
                        'cinzel': ['Cinzel', 'serif'],
                        'spectral': ['Spectral', 'serif'],
                        'fira': ['Fira Code', 'monospace'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { background-color: #0f0f0f; color: #e8e4df; font-family: 'Spectral', serif; }
        .rituals-card { background-color: #161615; border: 1px solid rgba(255,255,255,0.05); border-radius: 4px; }
        .rituals-table th { font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 2px; color: #9a9590; text-transform: uppercase; border-bottom: 1px solid rgba(255,255,255,0.05); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #1c1c1b; border-radius: 3px; }
    </style>
</head>
<body class="antialiased selection:bg-rituals-gold/30" x-data="{ activeTab: 'dashboard' }">
    <div class="flex min-h-screen">
        <!-- Professional Sidebar -->
        <aside class="w-64 bg-rituals-bg border-r border-rituals-border p-8 hidden lg:block z-20">
            <div class="mb-12">
                <h1 class="font-cinzel text-rituals-gold text-2xl tracking-[0.2em] font-bold">RITUALS</h1>
                <p class="font-cinzel text-[8px] text-rituals-text-muted tracking-[0.4em] uppercase mt-2 opacity-60">Admin Management</p>
            </div>
            
            <nav class="space-y-1">
                <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-rituals-surface-elevated border-rituals-gold text-rituals-text' : 'text-rituals-text-muted border-transparent hover:text-rituals-gold hover:bg-rituals-surface'" class="flex items-center w-full p-3 border-l-2 transition-all">
                    <span class="font-cinzel text-xs font-semibold tracking-widest uppercase">Dashboard</span>
                </button>
                <button @click="activeTab = 'orders'" :class="activeTab === 'orders' ? 'bg-rituals-surface-elevated border-rituals-gold text-rituals-text' : 'text-rituals-text-muted border-transparent hover:text-rituals-gold hover:bg-rituals-surface'" class="flex items-center w-full p-3 border-l-2 transition-all">
                    <span class="font-cinzel text-xs tracking-widest uppercase">Orders</span>
                </button>
                <button @click="activeTab = 'inventory'" :class="activeTab === 'inventory' ? 'bg-rituals-surface-elevated border-rituals-gold text-rituals-text' : 'text-rituals-text-muted border-transparent hover:text-rituals-gold hover:bg-rituals-surface'" class="flex items-center w-full p-3 border-l-2 transition-all">
                    <span class="font-cinzel text-xs tracking-widest uppercase">Inventory</span>
                </button>
                <button @click="activeTab = 'customers'" :class="activeTab === 'customers' ? 'bg-rituals-surface-elevated border-rituals-gold text-rituals-text' : 'text-rituals-text-muted border-transparent hover:text-rituals-gold hover:bg-rituals-surface'" class="flex items-center w-full p-3 border-l-2 transition-all">
                    <span class="font-cinzel text-xs tracking-widest uppercase">Customers</span>
                </button>
                
                <div class="pt-8 mt-8 border-t border-rituals-border">
                    <a href="{{ route('home') }}" class="flex items-center p-3 text-rituals-text-muted hover:text-rituals-red transition-all">
                        <span class="font-cinzel text-[10px] tracking-widest uppercase">Exit to Store</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Dashboard -->
        <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
            <!-- Simplified Header -->
            <header class="flex justify-between items-center mb-12">
                <h2 class="font-cinzel text-3xl font-bold tracking-widest text-rituals-text uppercase" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)">Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 px-3 py-1 bg-rituals-success/5 border border-rituals-success/20 rounded-full">
                        <span class="w-1.5 h-1.5 bg-rituals-success rounded-full shadow-[0_0_5px_#22C55E]"></span>
                        <span class="font-cinzel text-[9px] text-rituals-success uppercase tracking-widest font-bold">Site is Live</span>
                    </div>
                    <p class="font-fira text-[10px] text-rituals-text-muted opacity-50">{{ now()->format('Y.m.d H:i') }}</p>
                </div>
            </header>

            <!-- Tab: Dashboard -->
            <div x-show="activeTab === 'dashboard'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <!-- KPI Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="rituals-card p-6">
                    <p class="font-cinzel text-[9px] text-rituals-text-muted uppercase tracking-widest mb-3">Total Revenue</p>
                    <p class="font-cinzel text-2xl font-bold text-rituals-gold">{{ tenant('currency_symbol') ?? '€' }}{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="rituals-card p-6">
                    <p class="font-cinzel text-[9px] text-rituals-text-muted uppercase tracking-widest mb-3">Total Orders</p>
                    <p class="font-cinzel text-2xl font-bold text-rituals-text">{{ $totalOrders }}</p>
                </div>
                <div class="rituals-card p-6">
                    <p class="font-cinzel text-[9px] text-rituals-text-muted uppercase tracking-widest mb-3">Total Customers</p>
                    <p class="font-cinzel text-2xl font-bold text-rituals-text">{{ $totalUsers }}</p>
                </div>
                <div class="rituals-card p-6 border-rituals-gold/20">
                    <p class="font-cinzel text-[9px] text-rituals-gold uppercase tracking-widest mb-3">Gateway Status</p>
                    <p class="font-cinzel text-2xl font-bold text-rituals-text italic">Stripe Active</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-8">
                    <h3 class="font-cinzel text-[11px] text-rituals-gold uppercase tracking-[0.2em] mb-6">Recent Activity</h3>
                    <div class="rituals-card overflow-hidden">
                        <table class="w-full text-left rituals-table">
                            <thead class="bg-rituals-surface-elevated">
                                <tr>
                                    <th class="p-4">Order ID</th>
                                    <th class="p-4">Customer</th>
                                    <th class="p-4">Total</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-rituals-border font-spectral text-sm">
                                @foreach($recentOrders as $order)
                                    <tr class="hover:bg-rituals-surface-elevated/30 transition-colors">
                                        <td class="p-4 font-fira text-xs font-bold text-rituals-text">{{ $order->order_number }}</td>
                                        <td class="p-4 text-rituals-text-muted">{{ $order->user->name }}</td>
                                        <td class="p-4 text-rituals-gold font-bold">€{{ number_format($order->total_amount, 2) }}</td>
                                        <td class="p-4">
                                            <span class="text-[9px] font-cinzel font-bold uppercase tracking-widest text-rituals-success">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Inventory Alerts -->
                <div class="lg:col-span-4">
                    <h3 class="font-cinzel text-[11px] text-rituals-gold uppercase tracking-[0.2em] mb-6">Low Stock Alerts</h3>
                    <div class="space-y-3">
                        @foreach($lowStockProducts as $product)
                            <div class="rituals-card p-4 flex justify-between items-center group hover:bg-rituals-surface-elevated transition-all">
                                <div>
                                    <p class="font-cinzel text-xs font-bold text-rituals-text">{{ $product->name }}</p>
                                    <p class="font-cinzel text-[8px] text-rituals-text-muted mt-1 uppercase tracking-widest">{{ $product->collection }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-cinzel text-lg font-bold text-rituals-red">{{ $product->stock }}</p>
                                    <p class="font-fira text-[8px] text-rituals-text-muted uppercase">Stock</p>
                                </div>
                            </div>
                        @endforeach

                        @if($lowStockProducts->isEmpty())
                            <div class="rituals-card p-8 text-center border-dashed opacity-50">
                                <p class="font-spectral italic text-sm text-rituals-text-muted">All products well-stocked.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>

            <!-- Tab: Orders -->
            <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                <h3 class="font-cinzel text-[11px] text-rituals-gold uppercase tracking-[0.2em] mb-6">Order History</h3>
                <div class="rituals-card overflow-hidden">
                    <table class="w-full text-left rituals-table">
                        <thead class="bg-rituals-surface-elevated">
                            <tr>
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-rituals-border font-spectral text-sm">
                            @foreach($allOrders as $order)
                                <tr class="hover:bg-rituals-surface-elevated/30 transition-colors">
                                    <td class="p-4 font-fira text-xs font-bold text-rituals-text">{{ $order->order_number }}</td>
                                    <td class="p-4 text-rituals-text-muted">{{ $order->user->name }}</td>
                                    <td class="p-4 text-rituals-text-muted">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="p-4 text-rituals-gold font-bold">€{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="p-4">
                                        <span class="text-[9px] font-cinzel font-bold uppercase tracking-widest text-rituals-success">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab: Inventory -->
            <div x-show="activeTab === 'inventory'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                <h3 class="font-cinzel text-[11px] text-rituals-gold uppercase tracking-[0.2em] mb-6">Product Inventory</h3>
                <div class="rituals-card overflow-hidden">
                    <table class="w-full text-left rituals-table">
                        <thead class="bg-rituals-surface-elevated">
                            <tr>
                                <th class="p-4">Product</th>
                                <th class="p-4">Collection</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-rituals-border font-spectral text-sm">
                            @foreach($allProducts as $product)
                                <tr class="hover:bg-rituals-surface-elevated/30 transition-colors">
                                    <td class="p-4 font-spectral font-bold text-rituals-text">{{ $product->name }}</td>
                                    <td class="p-4 text-rituals-text-muted text-xs uppercase tracking-widest">{{ $product->collection }}</td>
                                    <td class="p-4 text-rituals-gold">€{{ number_format($product->price, 2) }}</td>
                                    <td class="p-4">
                                        <span class="{{ $product->stock < 10 ? 'text-rituals-red font-bold' : 'text-rituals-text' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab: Customers -->
            <div x-show="activeTab === 'customers'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                <h3 class="font-cinzel text-[11px] text-rituals-gold uppercase tracking-[0.2em] mb-6">Registered Customers</h3>
                <div class="rituals-card overflow-hidden">
                    <table class="w-full text-left rituals-table">
                        <thead class="bg-rituals-surface-elevated">
                            <tr>
                                <th class="p-4">Name</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Role</th>
                                <th class="p-4">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-rituals-border font-spectral text-sm">
                            @foreach($allUsers as $user)
                                <tr class="hover:bg-rituals-surface-elevated/30 transition-colors">
                                    <td class="p-4 font-spectral font-bold text-rituals-text">{{ $user->name }}</td>
                                    <td class="p-4 text-rituals-text-muted">{{ $user->email }}</td>
                                    <td class="p-4">
                                        <span class="text-[9px] font-cinzel font-bold uppercase tracking-widest {{ $user->role === 'admin' ? 'text-rituals-gold' : 'text-rituals-text-muted' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-rituals-text-muted">{{ $user->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
