<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;

class AyurvedicProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create or Find Brand
        $brand = Brand::firstOrCreate(
            ['slug' => 'ayurnaman'],
            [
                'name' => 'Ayurnaman',
                'description' => 'Authentic Ayurveda for Modern Living — crafted with 100% natural herbs.',
                'status' => 1
            ]
        );

        // 2. Categories from screenshot
        $categoriesData = [
            [
                'name' => 'Diabetic Care',
                'slug' => 'diabetic-care',
                'description' => 'Herbal support for healthy blood sugar and vitality.',
                'sort_order' => 1
            ],
            [
                'name' => 'Eye Care',
                'slug' => 'eye-care',
                'description' => 'Soothes, hydrates, and protects for refreshed eyes.',
                'sort_order' => 2
            ],
            [
                'name' => 'Skin Care',
                'slug' => 'skin-care',
                'description' => 'Ayurvedic formulations for glowing, youthful skin.',
                'sort_order' => 3
            ],
            [
                'name' => 'Hair Care',
                'slug' => 'hair-care',
                'description' => 'Deep herbal nourishment for stronger, shinier hair.',
                'sort_order' => 4
            ],
            [
                'name' => 'General Wellness',
                'slug' => 'general-wellness',
                'description' => 'Holistic digestion, immunity, and everyday health.',
                'sort_order' => 5
            ],
            [
                'name' => 'Anti-Ageing',
                'slug' => 'anti-ageing',
                'description' => 'Rejuvenating herbal actives to diminish fine lines and firm skin.',
                'sort_order' => 6
            ],
        ];

        $categoryMap = [];
        foreach ($categoriesData as $c) {
            $cat = Category::updateOrCreate(
                ['slug' => $c['slug']],
                [
                    'name' => $c['name'],
                    'description' => $c['description'],
                    'sort_order' => $c['sort_order'],
                    'status' => 1,
                ]
            );
            $categoryMap[$c['slug']] = $cat->id;
        }

        // 3. Products matching the 11 original images in public/images/products
        $products = [
            [
                'name' => 'Ayurnaman DIABS Capsules',
                'slug' => 'ayurnaman-diabs-capsules',
                'category_slug' => 'diabetic-care',
                'sku' => 'AYUR-DIABS-60',
                'price' => 899.00,
                'sale_price' => 699.00,
                'stock_quantity' => 120,
                'thumbnail' => '0.png',
                'short_description' => 'Herbal support for healthy blood sugar balance and everyday vitality (60 Capsules).',
                'description' => 'Ayurnaman DIABS Capsules combine pure Karela (Bitter Gourd), Methi (Fenugreek), Jamun seeds, and Neem extracts to maintain balanced glucose levels and enhance natural metabolic health.',
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Herbal Eye Drop',
                'slug' => 'ayurnaman-herbal-eye-drop',
                'category_slug' => 'eye-care',
                'sku' => 'AYUR-EYE-10',
                'price' => 349.00,
                'sale_price' => 249.00,
                'stock_quantity' => 200,
                'thumbnail' => '1.png',
                'short_description' => 'Soothes, hydrates & reduces irritation for refreshed and healthy eyes.',
                'description' => 'A gentle, sterile Ayurvedic preparation infused with pure Rose water, Honey, Chamomile, and Aloe Vera to relieve screen strain, dryness, and environmental pollutants.',
                'is_featured' => true,
                'is_new_arrival' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Anti-Ageing Cream',
                'slug' => 'ayurnaman-anti-ageing-cream',
                'category_slug' => 'anti-ageing',
                'sku' => 'AYUR-AAC-50',
                'price' => 1199.00,
                'sale_price' => 899.00,
                'stock_quantity' => 85,
                'thumbnail' => '2.jpg',
                'short_description' => 'Enriched with Hyaluronic Acid & Kokum Butter for firmer, youthful skin (50g).',
                'description' => 'Nourishing age-defying blend enriched with mangosteen antioxidants, natural hyaluronic acid, and pure kokum butter to reduce visible fine lines and firm skin elasticity.',
                'is_featured' => true,
                'is_new_arrival' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Ultimate Face Cream',
                'slug' => 'ayurnaman-ultimate-face-cream',
                'category_slug' => 'skin-care',
                'sku' => 'AYUR-UFC-50',
                'price' => 999.00,
                'sale_price' => 749.00,
                'stock_quantity' => 95,
                'thumbnail' => '3.jpg',
                'short_description' => 'Exfoliates, purifies and restores radiant natural moisture (50g).',
                'description' => 'Deep botanical moisturizing face cream infused with cold-pressed coconut oil, almond extracts, and fresh aloe vera gel for deep nourishment throughout the day.',
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Nourishing Hair Masque',
                'slug' => 'ayurnaman-hair-masque',
                'category_slug' => 'hair-care',
                'sku' => 'AYUR-HM-200',
                'price' => 799.00,
                'sale_price' => 599.00,
                'stock_quantity' => 110,
                'thumbnail' => '4.jpg',
                'short_description' => 'Shine Strong — Stay Soft. Deep nourishment for stronger, smoother hair (200ml).',
                'description' => 'Intense conditioning hair mask crafted with Hibiscus, Moroccan Argan Oil, Coconut milk, and Aloe Vera to repair damaged cuticles and restore silky softness.',
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman 24K Gold Face Serum',
                'slug' => 'ayurnaman-24k-gold-face-serum',
                'category_slug' => 'skin-care',
                'sku' => 'AYUR-24K-15',
                'price' => 1499.00,
                'sale_price' => 1149.00,
                'stock_quantity' => 70,
                'thumbnail' => '5.jpg',
                'short_description' => 'Revitalizes skin with pure Kashmiri Saffron and 24K gold flakes (15ml).',
                'description' => 'Luxury Ayurvedic elixir containing pure saffron, gold flakes, and botanical seed oils. Chemical-free, silicone-free, and preservative-free for luminous radiance.',
                'is_featured' => true,
                'is_new_arrival' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Gutswastha Digestive Syrup',
                'slug' => 'ayurnaman-gutswastha-syrup',
                'category_slug' => 'general-wellness',
                'sku' => 'AYUR-GUT-500',
                'price' => 499.00,
                'sale_price' => 389.00,
                'stock_quantity' => 140,
                'thumbnail' => '6.jpg',
                'short_description' => 'Digest Better — Live Better. Complete herbal gut and digestive wellness (500ml).',
                'description' => 'Traditional fermented herbal tonic with Saunf (Fennel), Ginger, Amla, and Mint. Stimulates healthy enzyme secretion and relieves bloating naturally.',
                'is_featured' => false,
                'is_new_arrival' => true,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Vitamin C Face Serum',
                'slug' => 'ayurnaman-vitamin-c-face-serum',
                'category_slug' => 'skin-care',
                'sku' => 'AYUR-VITC-30',
                'price' => 849.00,
                'sale_price' => 649.00,
                'stock_quantity' => 130,
                'thumbnail' => '7.jpg',
                'short_description' => 'Skin brightening & lightening with natural citrus extracts and Aloe Vera (30ml).',
                'description' => 'Potent antioxidant serum powered by cold-extracted orange, lemon bioflavonoids, and pure aloe vera to fade pigmentation and boost collagen.',
                'is_featured' => false,
                'is_new_arrival' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Ayurnaman Hyaluronic Acid Face Serum',
                'slug' => 'ayurnaman-hyaluronic-acid-face-serum',
                'category_slug' => 'skin-care',
                'sku' => 'AYUR-HA-30',
                'price' => 899.00,
                'sale_price' => 679.00,
                'stock_quantity' => 105,
                'thumbnail' => '8.jpg',
                'short_description' => 'Deep hydration, minimizes open pores, and brightens skin tone (30ml).',
                'description' => 'Multi-molecular hyaluronic acid combined with peppermint and lavender botanical waters for multi-depth plumping and long-lasting hydration.',
                'is_featured' => false,
                'is_new_arrival' => true,
                'is_best_seller' => false,
            ],
            [
                'name' => 'Ayurnaman Herbal Keratin Conditioner',
                'slug' => 'ayurnaman-keratin-conditioner',
                'category_slug' => 'hair-care',
                'sku' => 'AYUR-KC-300',
                'price' => 649.00,
                'sale_price' => 499.00,
                'stock_quantity' => 115,
                'thumbnail' => '9.jpg',
                'short_description' => 'Smoothes frizz instantly, repairs damaged strands & nourishes hair follicles (300ml).',
                'description' => 'Plant-based keratin infused with lavender blossom oil, virgin coconut oil, and vitamin E capsules for weightless shine and tangle-free hair.',
                'is_featured' => false,
                'is_new_arrival' => false,
                'is_best_seller' => true,
            ],
            [
                'name' => 'Ayurnaman Herbal Keratin Shampoo',
                'slug' => 'ayurnaman-keratin-shampoo',
                'category_slug' => 'hair-care',
                'sku' => 'AYUR-KS-300',
                'price' => 649.00,
                'sale_price' => 499.00,
                'stock_quantity' => 125,
                'thumbnail' => '10.jpg',
                'short_description' => 'Gentle cleansing, reduces hair fall & strengthens from roots (300ml).',
                'description' => 'Sulfate-free, paraben-free cleansing formula enriched with botanical keratin, cold-pressed coconut oil, and lavender to curb hair thinning.',
                'is_featured' => true,
                'is_new_arrival' => false,
                'is_best_seller' => true,
            ],
        ];

        foreach ($products as $p) {
            $catId = $categoryMap[$p['category_slug']] ?? null;
            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => $catId,
                    'brand_id' => $brand->id,
                    'name' => $p['name'],
                    'sku' => $p['sku'],
                    'price' => $p['price'],
                    'sale_price' => $p['sale_price'],
                    'cost_price' => $p['sale_price'] * 0.45,
                    'stock_quantity' => $p['stock_quantity'],
                    'low_stock_threshold' => 10,
                    'thumbnail' => $p['thumbnail'],
                    'short_description' => $p['short_description'],
                    'description' => $p['description'],
                    'is_featured' => $p['is_featured'],
                    'is_new_arrival' => $p['is_new_arrival'],
                    'is_best_seller' => $p['is_best_seller'],
                    'status' => 'active',
                    'views' => rand(150, 980),
                ]
            );

            // Ensure ProductImage record exists
            ProductImage::firstOrCreate(
                [
                    'product_id' => $product->id,
                    'image' => $p['thumbnail'],
                ],
                [
                    'is_primary' => true,
                    'sort_order' => 1,
                ]
            );
        }
    }
}
