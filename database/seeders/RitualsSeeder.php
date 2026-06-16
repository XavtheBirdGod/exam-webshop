<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Artisan;

class RitualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'id' => 'amsterdam',
                'name' => 'House of Rituals Amsterdam',
                'address' => 'Spui 10, 1012 WZ Amsterdam',
                'email' => 'amsterdam@rituals.com',
            ],
            [
                'id' => 'paris',
                'name' => 'Rituals Paris Vieille du Temple',
                'address' => '24 rue Vieille du Temple, 75004 Paris',
                'email' => 'paris@rituals.com',
            ],
            [
                'id' => 'london',
                'name' => 'Rituals London Oxford Street',
                'address' => '103 Oxford St, London W1D 2HF',
                'email' => 'london@rituals.com',
            ],
        ];

        foreach ($locations as $loc) {
            // Create Tenant
            $tenant = Tenant::updateOrCreate(['id' => $loc['id']], [
                'id' => $loc['id'],
                'city' => ucfirst($loc['id']),
                'country' => $loc['id'] === 'london' ? 'United Kingdom' : ($loc['id'] === 'paris' ? 'France' : 'Netherlands'),
                'currency' => $loc['id'] === 'london' ? 'GBP' : 'EUR',
                'currency_symbol' => $loc['id'] === 'london' ? '£' : '€',
            ]);
            $tenant->domains()->updateOrCreate(['domain' => $loc['id'] . '.localhost'], ['domain' => $loc['id'] . '.localhost']);

            // Create Manager for this location (Central User)
            $manager = User::updateOrCreate(
                ['email' => $loc['email']],
                [
                    'tenant_id' => $loc['id'],
                    'name' => 'Manager ' . $loc['name'],
                    'email' => $loc['email'],
                    'password' => bcrypt('password'),
                    'role' => 'seller',
                ]
            );

            // Create Shop record (Central)
            $shop = Shop::updateOrCreate(
                ['slug' => $loc['id']],
                [
                    'user_id' => $manager->id,
                    'name' => $loc['name'],
                    'description' => 'Official Rituals store in ' . ucfirst($loc['id']),
                    'slug' => $loc['id'],
                ]
            );

            // Seed Tenant Data
            $tenant->run(function () use ($shop, $loc) {
                $this->seedRitualsProducts($shop, $loc['id']);
                $this->call(OrderSeeder::class);
            });
        }
    }

    private function seedRitualsProducts($shop, $tenantId)
    {
        // Clear existing products to avoid duplicates during development
        Product::truncate();
        ProductVariant::truncate();

        $priceMultiplier = 1.0;
        $descSuffix = '';

        if ($tenantId === 'london') {
            $priceMultiplier = 1.15; // London premium
            $descSuffix = ' Available exclusively at our London flagship.';
        } elseif ($tenantId === 'paris') {
            $priceMultiplier = 1.05;
            $descSuffix = ' Un moment de détente parisien.';
        } elseif ($tenantId === 'amsterdam') {
            $descSuffix = ' Onze klassieker uit Amsterdam.';
        }

        $catalog = [
            'The Ritual of Sakura' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1000', 'desc' => 'Celebrate each day as a new beginning with the scent of Cherry Blossom and Rice Milk.'],
                    ['name' => 'Body Cream', 'cat' => 'Body Care', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=1000', 'desc' => 'A rich, velvety body cream that deeply nourishes and firms the skin.'],
                    ['name' => 'Body Scrub', 'cat' => 'Body Care', 'price' => 16.90, 'img' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?q=80&w=1000', 'desc' => 'A renewing body scrub with sugar and softening oils.'],
                    ['name' => 'Scented Candle', 'cat' => 'Home', 'price' => 24.90, 'img' => 'https://images.unsplash.com/photo-1603006905003-be475563bc59?q=80&w=1000', 'desc' => 'Illuminate your path to a new beginning.'],
                    ['name' => 'Hair & Body Mist', 'cat' => 'Fragrance', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1000', 'desc' => 'A light mist for hair and skin with the delicate scent of cherry blossom.'],
                ]
            ],
            'The Ritual of Ayurveda' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?q=80&w=1000', 'desc' => 'Restore inner harmony with Indian Rose and Sweet Almond Oil.'],
                    ['name' => 'Body Cream', 'cat' => 'Body Care', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=1000', 'desc' => 'Balancing body cream for a silky smooth skin.'],
                    ['name' => 'Fragrance Sticks', 'cat' => 'Home', 'price' => 27.90, 'img' => 'https://images.unsplash.com/photo-1588812684973-1002b8006b52?q=80&w=1000', 'desc' => 'Natural and stylish way to fragrance your home.'],
                    ['name' => 'Body Scrub', 'cat' => 'Body Care', 'price' => 15.90, 'img' => 'https://images.unsplash.com/photo-1552046122-03184de85e08?q=80&w=1000', 'desc' => 'Purifying body scrub with ancient Ayurvedic ingredients.'],
                ]
            ],
            'The Ritual of Jing' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?q=80&w=1000', 'desc' => 'Find your path to inner peace with Sacred Lotus and Jujube.'],
                    ['name' => 'Sleep Pillow & Body Mist', 'cat' => 'Body Care', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1552693673-1bf958298935?q=80&w=1000', 'desc' => 'Prepare for a restful sleep with this calming mist.'],
                    ['name' => 'Magnesium Bath Crystals', 'cat' => 'Bath & Shower', 'price' => 15.90, 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1000', 'desc' => 'Relax your muscles and mind in a soothing bath.'],
                    ['name' => 'Scented Candle', 'cat' => 'Home', 'price' => 24.90, 'img' => 'https://images.unsplash.com/photo-1602870427024-3813a1ed0a8a?q=80&w=1000', 'desc' => 'Create a calm atmosphere in your home.'],
                ]
            ],
            'The Ritual of Karma' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=1000', 'desc' => 'Radiate positivity with Holy Lotus and White Tea.'],
                    ['name' => 'Sun Protection Milky Spray SPF 30', 'cat' => 'Suncare', 'price' => 21.90, 'img' => 'https://images.unsplash.com/photo-1526947425960-945c6e72858f?q=80&w=1000', 'desc' => 'Protect your skin and the ocean with this non-sticky sun spray.'],
                    ['name' => 'Body Shimmer Oil', 'cat' => 'Body Care', 'price' => 21.50, 'img' => 'https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=1000', 'desc' => 'Get a sun-kissed glow with this shimmering oil.'],
                ]
            ],
            'The Ritual of Mehr' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1612817288484-6f916006741a?q=80&w=1000', 'desc' => 'Boost your energy with Sweet Orange and Cedar Wood.'],
                    ['name' => 'Body Cream', 'cat' => 'Body Care', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1000', 'desc' => 'Energizing body cream for an instant mood boost.'],
                    ['name' => 'Hair & Body Mist', 'cat' => 'Fragrance', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1547881330-b82b6a60f751?q=80&w=1000', 'desc' => 'A vibrant mist to uplift your soul.'],
                ]
            ],
            'The Ritual of Hammam' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1544161515-4ae6ce6ea8b8?q=80&w=1000', 'desc' => 'Purify your body and soul with Eucalyptus and Rosemary.'],
                    ['name' => 'Black Soap', 'cat' => 'Body Care', 'price' => 10.90, 'img' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?q=80&w=1000', 'desc' => 'Deeply cleansing traditional Moroccan black soap.'],
                    ['name' => 'Purifying Body Scrub', 'cat' => 'Body Care', 'price' => 16.90, 'img' => 'https://images.unsplash.com/photo-1505330622279-bf7d7fc918f4?q=80&w=1000', 'desc' => 'A refreshing hot scrub based on sea salt and eucalyptus.'],
                ]
            ],
            'Homme' => [
                'products' => [
                    ['name' => '2-in-1 Shampoo & Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?q=80&w=1000', 'desc' => 'The ultimate 2-in-1 for a high-performance lifestyle.'],
                    ['name' => 'Shave Cream', 'cat' => 'Shave', 'price' => 21.90, 'img' => 'https://images.unsplash.com/photo-1584305658850-d9d5f578440c?q=80&w=1000', 'desc' => 'Non-lathering shave cream for an extra close shave.'],
                    ['name' => 'Anti-Dryness Body Lotion', 'cat' => 'Body Care', 'price' => 14.90, 'img' => 'https://images.unsplash.com/photo-1626480923417-da0d49d0e36a?q=80&w=1000', 'desc' => 'Hydrating body lotion that absorbs quickly.'],
                ]
            ],
            'Amsterdam Collection' => [
                'products' => [
                    ['name' => 'Foaming Shower Gel', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1512756783936-3979c5f11732?q=80&w=1000', 'desc' => 'Dutch Tulip and Japanese Yuzu come together in a unique collaboration with the Rijksmuseum.'],
                    ['name' => 'Body Cream', 'cat' => 'Body Care', 'price' => 19.90, 'img' => 'https://images.unsplash.com/photo-1556228443-7204e9c8a6d8?q=80&w=1000', 'desc' => 'Deeply nourishing body cream with a fresh, floral scent.'],
                    ['name' => 'Scented Candle', 'cat' => 'Home', 'price' => 25.90, 'img' => 'https://images.unsplash.com/photo-1602870427024-3813a1ed0a8a?q=80&w=1000', 'desc' => 'Beautifully designed candle that fills your home with the scent of the Golden Age.'],
                ]
            ],
            'Sport' => [
                'products' => [
                    ['name' => '2-in-1 Shampoo & Body Wash', 'cat' => 'Bath & Shower', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1000', 'desc' => 'Cooling body wash with mint and activated charcoal.'],
                    ['name' => 'Anti-Perspirant Spray', 'cat' => 'Body Care', 'price' => 9.90, 'img' => 'https://images.unsplash.com/photo-1594433830870-8453a1b80dac?q=80&w=1000', 'desc' => 'High-performance protection for active lifestyles.'],
                    ['name' => 'Magnesium Body Recovery Gel', 'cat' => 'Body Care', 'price' => 15.90, 'img' => 'https://images.unsplash.com/photo-1507398941214-57f196a6350d?q=80&w=1000', 'desc' => 'Help your muscles recover after a workout.'],
                ]
            ],
            'The Ritual of Namaste' => [
                'products' => [
                    ['name' => 'Bakuchiol Repair Serum', 'cat' => 'Skincare', 'price' => 34.90, 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=1000', 'desc' => 'Advanced Repair Serum with natural Bakuchiol for glowing skin.'],
                    ['name' => 'Velvety Smooth Cleansing Foam', 'cat' => 'Skincare', 'price' => 14.90, 'img' => 'https://images.unsplash.com/photo-1556229010-6c3f2c9ca5f8?q=80&w=1000', 'desc' => 'Cleanse and purify with this gentle foaming wash.'],
                    ['name' => 'Active Firming Day Cream', 'cat' => 'Skincare', 'price' => 39.90, 'img' => 'https://images.unsplash.com/photo-1556228443-7204e9c8a6d8?q=80&w=1000', 'desc' => 'Firm and lift your skin with natural ingredients.'],
                ]
            ],
        ];

        foreach ($catalog as $collectionName => $data) {
            foreach ($data['products'] as $pData) {
                // Determine popularity based on city
                $popularity = rand(10, 50); // base
                if ($tenantId === 'london' && $collectionName === 'The Ritual of Jing') $popularity += 50;
                if ($tenantId === 'paris' && $collectionName === 'The Ritual of Sakura') $popularity += 50;
                if ($tenantId === 'amsterdam' && $collectionName === 'Amsterdam Collection') $popularity += 50;
                if ($tenantId === 'amsterdam' && $collectionName === 'Sport') $popularity += 40;

                $product = Product::create([
                    'shop_id' => $shop->id,
                    'name' => $pData['name'],
                    'collection' => $collectionName,
                    'category' => $pData['cat'],
                    'image_url' => $pData['img'],
                    'description' => $pData['desc'] . $descSuffix,
                    'price' => round($pData['price'] * $priceMultiplier, 2),
                    'stock' => rand(20, 100),
                    'popularity' => $popularity, // New field for localized ordering
                ]);

                // Create a few standard variants
                ProductVariant::create([
                    'product_id' => $product->id,
                    'type' => 'Size',
                    'value' => 'Full Size',
                    'additional_price' => 0,
                    'stock' => rand(10, 50),
                ]);

                if (str_contains($pData['name'], 'Shower Gel')) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'type' => 'Size',
                        'value' => 'Travel Size (50ml)',
                        'additional_price' => -4.00,
                        'stock' => rand(5, 20),
                    ]);
                }
            }
        }
    }
}
