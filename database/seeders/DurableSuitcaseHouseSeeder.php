<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Page;
use App\Models\Megamenu;
use App\Models\MegamenuColumn;
use App\Models\MegamenuItem;
use App\Models\ShippingMethod;
use App\Models\Coupon;
use App\Models\Slider;

class DurableSuitcaseHouseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        $settings = [
            ['site_name', 'Durable Suitcase House', 'general'],
            ['site_tagline', 'A Legacy of Trust. A Journey Since 1960', 'general'],
            ['site_email', 'durablesuitcasehouse@gmail.com', 'general'],
            ['site_phone', '9914469211', 'general'],
            ['site_phone_alt', '9814041822', 'general'],
            ['site_whatsapp', '9914469211', 'general'],
            ['site_address', 'Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab - 147001', 'general'],
            ['site_city', 'Patiala', 'general'],
            ['currency', 'INR', 'general'],
            ['currency_symbol', '₹', 'general'],
            ['free_shipping_above', '1999', 'general'],
            ['tax_rate', '0', 'general'],
            ['meta_title', 'Durable Suitcase House — Luggage, School Bags, Handbags & Travel Essentials Since 1960', 'seo'],
            ['meta_description', 'Welcome to Durable Suitcase House Patiala. Your trusted destination for luggage, trolleys, school bags, ladies handbags, bridal purses and travel accessories since 1960.', 'seo'],
            ['site_description', 'Welcome to Durable Suitcase House — A name synonymous with trust, quality, and a passion for travel since 1960. Serving generations with premium luggage, school bags, ladies handbags & bridal collections.', 'general'],
            ['site_logo', 'logo.png', 'general'],
            ['site_favicon', 'favicon.png', 'general'],
            ['cod_enabled', '1', 'payment'],
        ];

        foreach ($settings as [$key, $value, $group]) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }

        // 2. Managed Static Pages
        $aboutContent = <<<'HTML'
<h2>A Legacy of Trust. A Journey Since 1960</h2>
<p class="lead">Welcome to <strong>Durable Suitcase House</strong> — a name synonymous with trust, quality, and a passion for travel since 1960.</p>
<p>With over six decades of experience, we have proudly served generations of customers, helping them find the perfect companions for every journey, every occasion, and every stage of life. What began as a commitment to quality and customer satisfaction has grown into a trusted destination for all your travel and everyday carry essentials.</p>
<p>We deal exclusively in a wide range of <strong>luggage, school bags, ladies’ handbags, bridal purses, and travel accessories</strong>, bringing together quality, style, durability, and value under one roof.</p>

<h3>Our Core Categories & Brands</h3>
<p>At Durable Suitcase House, we believe every journey deserves the right companion. Whether you’re preparing for a family vacation, sending your child to school, looking for an elegant handbag, or choosing accessories for your next adventure, we strive to offer products that meet your needs and exceed your expectations.</p>
<ul>
    <li><strong>Luggage & Trolleys:</strong> American Tourister, Samsonite, Kamiliant, Safari, VIP, Swiss Military, Gear, Aristocrat, Tommy Hilfiger, Delsey Paris</li>
    <li><strong>Ladies Handbags:</strong> Wranglers, Itti, Aldo, Magnolia, Sequence, Logos, Emily Loran</li>
    <li><strong>School Bags & Backpacks:</strong> Safari, American Tourister, Genie, Kamiliant, Gear, Tommy Hilfiger, Swiss Military</li>
    <li><strong>Bridal Purse Collection:</strong> Huge curated range of wedding and bridal clutches, party potlis, and stone-embellished evening purses.</li>
</ul>

<p>Our greatest achievement is not just the years behind us, but the trust and relationships we have built along the way.</p>
<p><em>Since 1960, and for generations to come — your journey is our legacy.</em></p>

<h3>Visit Our Store</h3>
<p><strong>Address:</strong> Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab - 147001<br>
<strong>Phone:</strong> +91 9914469211 / +91 9814041822 / +91 9914141822<br>
<strong>Email:</strong> durablesuitcasehouse@gmail.com</p>
HTML;

        Page::updateOrCreate(['slug' => 'about'], [
            'title' => 'About Us',
            'content' => $aboutContent,
            'meta_title' => 'About Durable Suitcase House — A Legacy Since 1960',
            'meta_description' => 'Over six decades of trust, quality, and travel heritage. Explore our legacy in Patiala since 1960.',
            'status' => true,
        ]);

        Page::updateOrCreate(['slug' => 'terms'], [
            'title' => 'Terms & Conditions',
            'content' => '<h2>Terms & Conditions</h2><p>Welcome to Durable Suitcase House. By using our website and purchasing our luggage and accessory products, you agree to comply with our terms of service, warranty coverage guidelines, and delivery conditions.</p>',
            'meta_title' => 'Terms & Conditions — Durable Suitcase House',
            'meta_description' => 'Terms and conditions for shopping at Durable Suitcase House.',
            'status' => true,
        ]);

        Page::updateOrCreate(['slug' => 'privacy'], [
            'title' => 'Privacy Policy',
            'content' => '<h2>Privacy Policy</h2><p>Your privacy and trust are our top priorities. We safeguard your personal contact details, delivery addresses, and payment information with rigorous security standards.</p>',
            'meta_title' => 'Privacy Policy — Durable Suitcase House',
            'meta_description' => 'Privacy policy of Durable Suitcase House.',
            'status' => true,
        ]);

        Page::updateOrCreate(['slug' => 'refund'], [
            'title' => 'Refund & Warranty Policy',
            'content' => '<h2>Refund & Warranty Policy</h2><p>All luggage items from authorized brands (American Tourister, Safari, VIP, Samsonite, etc.) carry genuine manufacturer international/national warranties. Returns or exchanges for unused items in original condition are supported within 7 days of delivery.</p>',
            'meta_title' => 'Refund & Warranty Policy — Durable Suitcase House',
            'meta_description' => 'Refund and warranty guidelines for luggage and bags at Durable Suitcase House.',
            'status' => true,
        ]);

        // 3. Categories from handwritten note
        $categoriesData = [
            [
                'name' => 'Luggage',
                'slug' => 'luggage',
                'description' => 'Hard trolley suitcases, soft luggage, expandable spinners, duffels and travel bags from top global brands.',
                'children' => [
                    ['Hard Trolley Suitcases', 'hard-trolley-suitcases'],
                    ['Soft Luggage & Spinners', 'soft-luggage'],
                    ['Cabin Luggage', 'cabin-luggage'],
                    ['Travel Duffle Bags', 'travel-duffle-bags'],
                ]
            ],
            [
                'name' => 'Ladies Handbags',
                'slug' => 'ladies-handbags',
                'description' => 'Trendy shoulder bags, premium leather totes, satchels, and designer everyday carry handbags.',
                'children' => [
                    ['Tote Bags', 'tote-bags'],
                    ['Shoulder Bags', 'shoulder-bags'],
                    ['Crossbody & Slings', 'crossbody-slings'],
                    ['Office & Laptop Handbags', 'office-handbags'],
                ]
            ],
            [
                'name' => 'School Bags',
                'slug' => 'school-bags',
                'description' => 'Ergonomic school bags, college backpacks, casual daypacks and lightweight kids carry bags.',
                'children' => [
                    ['Ergonomic School Backpacks', 'ergonomic-school-backpacks'],
                    ['College & Laptop Backpacks', 'college-backpacks'],
                    ['Kids Character Bags', 'kids-school-bags'],
                    ['Casual Daypacks', 'casual-daypacks'],
                ]
            ],
            [
                'name' => 'Bridal Purse Collection',
                'slug' => 'bridal-purse-collection',
                'description' => 'Exquisite bridal clutches, royal wedding potlis, golden shimmer purses, and party evening clutches.',
                'children' => [
                    ['Bridal Wedding Clutches', 'bridal-wedding-clutches'],
                    ['Embroidered Potli Bags', 'embroidered-potlis'],
                    ['Crystal & Stone Evening Purses', 'crystal-evening-purses'],
                    ['Cocktail Box Clutches', 'cocktail-box-clutches'],
                ]
            ],
            [
                'name' => 'Travel Accessories',
                'slug' => 'travel-accessories',
                'description' => 'TSA locks, luggage tags, neck pillows, organizers, toiletry pouches, and travel rain covers.',
                'children' => [
                    ['Luggage Straps & Locks', 'luggage-locks'],
                    ['Toiletry & Travel Pouches', 'travel-pouches'],
                    ['Travel Organizers', 'travel-organizers'],
                ]
            ]
        ];

        $categoryMap = [];
        $order = 1;
        foreach ($categoriesData as $cData) {
            $cat = Category::updateOrCreate(['slug' => $cData['slug']], [
                'name' => $cData['name'],
                'description' => $cData['description'],
                'sort_order' => $order++,
                'status' => true,
            ]);
            $categoryMap[$cData['slug']] = $cat->id;

            $cOrder = 1;
            foreach ($cData['children'] as [$childName, $childSlug]) {
                $subCat = Category::updateOrCreate(['slug' => $childSlug], [
                    'name' => $childName,
                    'parent_id' => $cat->id,
                    'sort_order' => $cOrder++,
                    'status' => true,
                ]);
                $categoryMap[$childSlug] = $subCat->id;
            }
        }

        // 4. Brands from handwritten note
        $brandsList = [
            // Luggage brands
            'American Tourister', 'Samsonite', 'Kamiliant', 'Safari', 'VIP', 'Swiss Military', 'Gear', 'Aristocrat', 'Tommy Hilfiger', 'Delsey Paris',
            // Ladies Handbags
            'Wrangler', 'Itti', 'Aldo', 'Magnolia', 'Sequence', 'Logos', 'Emily Loran',
            // School Bags
            'Genie'
        ];

        $brandMap = [];
        foreach ($brandsList as $bName) {
            $brandSlug = Str::slug($bName);
            $brand = Brand::updateOrCreate(['slug' => $brandSlug], [
                'name' => $bName,
                'status' => true,
            ]);
            $brandMap[$brandSlug] = $brand->id;
        }

        // 5. Products across all 4 main categories with realistic prices in INR
        $productsSeed = [
            // --- Luggage ---
            [
                'name' => 'Safari Pentagon 3-Piece Polypropylene Trolley Set (55, 65, 75 cm)',
                'slug' => 'safari-pentagon-3-piece-trolley-set',
                'category_slug' => 'luggage',
                'brand_slug' => 'safari',
                'sku' => 'SAF-PENT-3SET',
                'price' => 12999.00,
                'sale_price' => 7499.00,
                'short_description' => 'Unbreakable 100% polypropylene hard-sided 8-wheel spinner luggage set with TSA lock.',
                'description' => 'Experience effortless travel with the Safari Pentagon 3-Piece Trolley Set. Engineered with ultra-durable, scratch-resistant polypropylene shell, 360-degree silent dual spinner wheels, and recessed combination TSA lock. Perfect for both short weekend getaways and extended international holidays.',
                'material' => 'Polypropylene (Unbreakable)',
                'metal_type' => 'Navy Blue Finish',
                'stone_type' => 'Cabin, Medium & Large',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'American Tourister Curio Hard-Sided Spinner Suitcase 68cm',
                'slug' => 'american-tourister-curio-spinner-68cm',
                'category_slug' => 'hard-trolley-suitcases',
                'brand_slug' => 'american-tourister',
                'sku' => 'AT-CURIO-68',
                'price' => 8990.00,
                'sale_price' => 5499.00,
                'short_description' => 'Iconic ripple design with expandability, smooth double wheels, and TSA certified security.',
                'description' => 'American Tourister Curio is crafted for modern explorers. Featuring expandable packing capacity, lightweight polycarbonate construction, and shock-absorbing multi-directional wheels.',
                'material' => 'Polycarbonate',
                'metal_type' => 'Charcoal Matte',
                'stone_type' => 'Medium Check-in',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1581553680321-4fffae59fccd?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'VIP Aristocrat Lightweight Soft-Sided 4-Wheel Trolley 55cm',
                'slug' => 'vip-aristocrat-lightweight-soft-trolley-55cm',
                'category_slug' => 'cabin-luggage',
                'brand_slug' => 'vip',
                'sku' => 'VIP-ARIST-55',
                'price' => 4500.00,
                'sale_price' => 2799.00,
                'short_description' => 'Ultra-lightweight polyester cabin bag with front quick-access pockets and smooth glide wheels.',
                'description' => 'Ideal for business and short flights, this VIP Aristocrat trolley provides convenient organization with padded exterior laptop pockets, corner guards, and smooth 360-degree corner wheels.',
                'material' => 'High-Density Polyester',
                'metal_type' => 'Navy Blue',
                'stone_type' => 'Cabin 55cm',
                'is_featured' => false,
                'is_best_seller' => true,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Swiss Military Heavy-Duty Expandable Duffel Trolley Bag',
                'slug' => 'swiss-military-heavy-duty-duffel-trolley',
                'category_slug' => 'travel-duffle-bags',
                'brand_slug' => 'swiss-military',
                'sku' => 'SM-DUFF-TRL',
                'price' => 5990.00,
                'sale_price' => 3899.00,
                'short_description' => 'Rugged military-grade water-resistant duffel with retractable telescopic handle and inline skate wheels.',
                'description' => 'Engineered for adventure, this Swiss Military travel duffel combines the versatility of a duffel bag with the convenience of rolling luggage. Reinforced stitching and tear-resistant ballistic fabric.',
                'material' => 'Ballistic Nylon',
                'metal_type' => 'Charcoal Military Grey',
                'stone_type' => '70 Litres',
                'is_featured' => true,
                'is_best_seller' => false,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=700&q=80&fit=crop',
            ],

            // --- Ladies Handbags ---
            [
                'name' => 'Aldo Quilted Luxury Flap Shoulder Bag with Gold Chain',
                'slug' => 'aldo-quilted-luxury-flap-shoulder-bag',
                'category_slug' => 'ladies-handbags',
                'brand_slug' => 'aldo',
                'sku' => 'ALDO-QLT-SHLD',
                'price' => 6999.00,
                'sale_price' => 4499.00,
                'short_description' => 'Timeless diamond-quilted vegan leather with premium brushed gold turn-lock hardware.',
                'description' => 'Elevate your everyday and evening look with this Aldo classic quilted shoulder bag. Features a dual-compartment interior, zippered secret pocket, and adjustable woven gold chain strap.',
                'material' => 'Vegan Leather',
                'metal_type' => 'Brushed Gold Hardware',
                'stone_type' => 'Dusty Rose & Cream',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Wrangler Genuine Leather Everyday Structured Tote Bag',
                'slug' => 'wrangler-genuine-leather-structured-tote-bag',
                'category_slug' => 'tote-bags',
                'brand_slug' => 'wrangler',
                'sku' => 'WRG-TOTE-BRN',
                'price' => 5490.00,
                'sale_price' => 3799.00,
                'short_description' => 'Spacious structured tote with dedicated laptop compartment and reinforced leather handles.',
                'description' => 'The ultimate work and weekend tote by Wrangler. Handcrafted with textured leather, spacious main zipper compartment, protective metal base feet, and detachable crossbody strap.',
                'material' => 'Textured PU Leather',
                'metal_type' => 'Antique Brass',
                'stone_type' => 'Taupe & Mocha',
                'is_featured' => true,
                'is_best_seller' => false,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Emily Loran Parisian Chic Crossbody Sling Bag',
                'slug' => 'emily-loran-parisian-chic-crossbody-sling',
                'category_slug' => 'crossbody-slings',
                'brand_slug' => 'emily-loran',
                'sku' => 'EL-SLING-01',
                'price' => 3499.00,
                'sale_price' => 2199.00,
                'short_description' => 'Compact yet spacious crossbody bag with stylish gold accents and quick-magnetic closure.',
                'description' => 'Crafted for effortless mobility, the Emily Loran crossbody keeps your phone, cards, cosmetics and sunglasses organized with multiple internal partitions.',
                'material' => 'Soft Nappa Finish',
                'metal_type' => 'Gold',
                'stone_type' => 'Classic Navy',
                'is_featured' => false,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Magnolia Sequence Designer Handbag with Matching Pouch',
                'slug' => 'magnolia-sequence-designer-handbag-with-pouch',
                'category_slug' => 'ladies-handbags',
                'brand_slug' => 'magnolia',
                'sku' => 'MAG-SEQ-HND',
                'price' => 4999.00,
                'sale_price' => 3299.00,
                'short_description' => 'Contemporary geometric silhouette with matching companion clutch and gold signature monogram.',
                'description' => 'A statement accessory for weddings, festive dinners, and corporate parties. Comes with a matching zippered organizer pouch.',
                'material' => 'Premium Saffiano Leatherette',
                'metal_type' => 'Pale Gold',
                'stone_type' => 'Deep Plum & Charcoal',
                'is_featured' => true,
                'is_best_seller' => false,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1591561954557-26941169b49e?w=700&q=80&fit=crop',
            ],

            // --- School Bags & Backpacks ---
            [
                'name' => 'Safari Spine-Comfort Ergonomic School Bag (35L)',
                'slug' => 'safari-spine-comfort-ergonomic-school-bag',
                'category_slug' => 'school-bags',
                'brand_slug' => 'safari',
                'sku' => 'SAF-SCH-SPINE',
                'price' => 2799.00,
                'sale_price' => 1799.00,
                'short_description' => 'Orthopedic back support padding, 3 spacious compartments, and integrated rain cover.',
                'description' => 'Designed to protect growing spines, the Safari Spine-Comfort school bag distributes weight evenly across shoulders. Includes water bottle pockets, reflective safety strips, and water-resistant bottom lining.',
                'material' => 'Waterproof 600D Polyester',
                'metal_type' => 'Heavy Duty SBS Zippers',
                'stone_type' => '35 Litres / 3 Compartments',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'American Tourister Tech-Ready College & Laptop Backpack (32L)',
                'slug' => 'american-tourister-tech-ready-college-backpack',
                'category_slug' => 'college-backpacks',
                'brand_slug' => 'american-tourister',
                'sku' => 'AT-LAP-TECH32',
                'price' => 3400.00,
                'sale_price' => 2299.00,
                'short_description' => 'Cushioned 15.6 inch laptop sleeve, external USB pass-through port, and breathable air-mesh back panel.',
                'description' => 'Built for college students and professionals, this American Tourister backpack delivers smart organization with separate stationery organizers, key fob, and ergonomic S-curve shoulder straps.',
                'material' => 'Ripstop Polyester',
                'metal_type' => 'Black Matte Hardware',
                'stone_type' => 'Laptop Fit 15.6"',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Genie Whimsical Printed School Bag for Girls with Lunch Pouch',
                'slug' => 'genie-whimsical-printed-school-bag',
                'category_slug' => 'school-bags',
                'brand_slug' => 'genie',
                'sku' => 'GEN-GIRL-PRT',
                'price' => 2499.00,
                'sale_price' => 1599.00,
                'short_description' => 'Vibrant lightweight school bag with cushioned straps, secret pocket, and complimentary pencil case.',
                'description' => 'Brighten school days with Genie’s enchanting backpack. Ultra-light design prevents fatigue while durable construction withstands daily classroom adventures.',
                'material' => 'Feather-Light Poly-Canvas',
                'metal_type' => 'Durable Nylon Zippers',
                'stone_type' => '28 Litres',
                'is_featured' => false,
                'is_best_seller' => false,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Tommy Hilfiger Signature Crest Urban Commuter Backpack',
                'slug' => 'tommy-hilfiger-signature-crest-urban-backpack',
                'category_slug' => 'college-backpacks',
                'brand_slug' => 'tommy-hilfiger',
                'sku' => 'TH-URB-CREST',
                'price' => 7999.00,
                'sale_price' => 5499.00,
                'short_description' => 'Iconic navy & cream heritage styling with padded tablet/laptop compartment.',
                'description' => 'Sophisticated urban backpack by Tommy Hilfiger featuring distinctive heritage stripes, top grab carry handle, and reinforced water-repellent base.',
                'material' => 'Premium Coated Canvas',
                'metal_type' => 'Heritage Navy Trim',
                'stone_type' => 'Urban Commute',
                'is_featured' => true,
                'is_best_seller' => false,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1577733966973-d680bffd2e80?w=700&q=80&fit=crop',
            ],

            // --- Bridal Purse Collection ---
            [
                'name' => 'Royal Kundan & Zardozi Handcrafted Bridal Potli with Pearl Handle',
                'slug' => 'royal-kundan-zardozi-bridal-potli',
                'category_slug' => 'bridal-purse-collection',
                'brand_slug' => 'sequence',
                'sku' => 'BRD-POTLI-KUN',
                'price' => 3999.00,
                'sale_price' => 2699.00,
                'short_description' => 'Intricate gold zardozi embroidery adorned with hand-stitched faux pearls and golden drawstrings.',
                'description' => 'A royal heirloom piece for brides and wedding guests. Hand-embroidered on rich velvet with shimmering golden thread, finished with elaborate pearl latkan tassels.',
                'material' => 'Raw Silk & Velvet',
                'metal_type' => 'Gold Threadwork',
                'stone_type' => 'Pearl & Kundan Work',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Dazzling Crystal Embellished Wedding Box Clutch',
                'slug' => 'dazzling-crystal-embellished-wedding-box-clutch',
                'category_slug' => 'bridal-purse-collection',
                'brand_slug' => 'logos',
                'sku' => 'BRD-BOX-CRYS',
                'price' => 4500.00,
                'sale_price' => 2999.00,
                'short_description' => 'Hard-case bridal box clutch encrusted with premium glass crystals and detachable gold snake chain.',
                'description' => 'Catch every ray of light at evening receptions and sangeet ceremonies. The magnetic jewel clasp and satin-lined interior keep your wedding essentials secure in style.',
                'material' => 'Metal Hardcase & Glass Crystals',
                'metal_type' => 'Polished Gold Frame',
                'stone_type' => 'Clear Faceted Crystals',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => false,
                'thumbnail' => 'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Shimmering Golden Brocade Traditional Bridal Purse',
                'slug' => 'shimmering-golden-brocade-bridal-purse',
                'category_slug' => 'bridal-purse-collection',
                'brand_slug' => 'sequence',
                'sku' => 'BRD-BROC-GLD',
                'price' => 2800.00,
                'sale_price' => 1899.00,
                'short_description' => 'Traditional Banarasi brocade purse with antique golden zari work and structured clasp.',
                'description' => 'Complements heavy lehengas, bridal suits, and sarees effortlessly. Features a comfortable curved wristlet handle and room for smartphones and cosmetics.',
                'material' => 'Pure Banarasi Brocade',
                'metal_type' => 'Antique Gold',
                'stone_type' => 'Zari & Stone Accents',
                'is_featured' => false,
                'is_best_seller' => false,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=700&q=80&fit=crop',
            ],
            [
                'name' => 'Pearl Encrusted Champagne Evening Party Minaudière',
                'slug' => 'pearl-encrusted-champagne-evening-minaudiere',
                'category_slug' => 'bridal-purse-collection',
                'brand_slug' => 'emily-loran',
                'sku' => 'BRD-MIN-CHAMP',
                'price' => 4200.00,
                'sale_price' => 2799.00,
                'short_description' => 'Curved oval minaudière clutch with multi-size pearls, rhinestone clasp, and champagne metallic finish.',
                'description' => 'The ultimate chic bridal purse for modern receptions and cocktail parties. Lightweight yet luxurious in hand.',
                'material' => 'Pearlescent Resin & Acrylic',
                'metal_type' => 'Gold Alloy Rim',
                'stone_type' => 'Lustrous Pearls',
                'is_featured' => true,
                'is_best_seller' => true,
                'is_new_arrival' => true,
                'thumbnail' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=700&q=80&fit=crop',
            ],
        ];

        foreach ($productsSeed as $p) {
            $catId = $categoryMap[$p['category_slug']] ?? $categoryMap['luggage'];
            $brandId = $brandMap[$p['brand_slug']] ?? null;

            $product = Product::updateOrCreate(['slug' => $p['slug']], [
                'category_id' => $catId,
                'brand_id' => $brandId,
                'name' => $p['name'],
                'sku' => $p['sku'],
                'short_description' => $p['short_description'],
                'description' => $p['description'],
                'price' => $p['price'],
                'sale_price' => $p['sale_price'],
                'cost_price' => $p['sale_price'] * 0.65,
                'stock_quantity' => rand(15, 60),
                'low_stock_threshold' => 5,
                'weight' => rand(2, 5) * 0.8,
                'material' => $p['material'],
                'metal_type' => $p['metal_type'],
                'stone_type' => $p['stone_type'],
                'is_featured' => $p['is_featured'],
                'is_new_arrival' => $p['is_new_arrival'],
                'is_best_seller' => $p['is_best_seller'],
                'status' => 'active',
                'thumbnail' => $p['thumbnail'],
                'meta_title' => $p['name'] . ' — Durable Suitcase House',
                'meta_description' => $p['short_description'],
            ]);

            // Add secondary image
            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'image' => $p['thumbnail'],
            ], [
                'alt_text' => $product->name,
                'sort_order' => 1,
                'is_primary' => true,
            ]);
        }

        // 6. Megamenus tailored for Durable Suitcase House
        DB::table('megamenu_items')->delete();
        DB::table('megamenu_columns')->delete();
        DB::table('megamenus')->delete();

        $menusConfig = [
            [
                'title' => 'Luggage & Trolleys',
                'type' => 'megamenu',
                'url' => '/shop?category=luggage',
                'icon' => 'bi-suitcase-lg',
                'badge_text' => 'POPULAR',
                'badge_color' => '#142D4E',
                'sort_order' => 1,
                'columns' => [
                    ['BY TYPE', [
                        ['Hard-Sided Suitcases', '/shop?category=hard-trolley-suitcases', 'bi-shield-check'],
                        ['Soft-Sided Luggage', '/shop?category=soft-luggage', 'bi-bag'],
                        ['Cabin Size (55cm)', '/shop?category=cabin-luggage', 'bi-airplane'],
                        ['3-Piece Trolley Sets', '/shop?category=luggage', 'bi-layers'],
                        ['Travel Duffel Bags', '/shop?category=travel-duffle-bags', 'bi-handbag'],
                    ]],
                    ['FEATURED BRANDS', [
                        ['American Tourister', '/shop?brand=american-tourister', 'bi-check2-circle'],
                        ['Safari Luggage', '/shop?brand=safari', 'bi-check2-circle'],
                        ['VIP & Aristocrat', '/shop?brand=vip', 'bi-check2-circle'],
                        ['Samsonite & Kamiliant', '/shop?brand=samsonite', 'bi-check2-circle'],
                        ['Swiss Military & Gear', '/shop?brand=swiss-military', 'bi-check2-circle'],
                        ['Tommy Hilfiger & Delsey', '/shop?brand=tommy-hilfiger', 'bi-check2-circle'],
                    ]],
                    ['BY OCCASION & SIZE', [
                        ['International Travel', '/shop?category=luggage', 'bi-globe2'],
                        ['Weekend Getaways', '/shop?category=cabin-luggage', 'bi-calendar2-week'],
                        ['Family Vacations', '/shop?category=luggage', 'bi-people'],
                        ['Business & Cabin Ready', '/shop?category=cabin-luggage', 'bi-briefcase'],
                    ]]
                ]
            ],
            [
                'title' => 'Ladies Handbags',
                'type' => 'megamenu',
                'url' => '/shop?category=ladies-handbags',
                'icon' => 'bi-handbag',
                'badge_text' => 'TRENDING',
                'badge_color' => '#C59A55',
                'sort_order' => 2,
                'columns' => [
                    ['BAG STYLES', [
                        ['All Handbags', '/shop?category=ladies-handbags', 'bi-bag'],
                        ['Tote Bags', '/shop?category=tote-bags', 'bi-bag-heart'],
                        ['Shoulder Bags', '/shop?category=shoulder-bags', 'bi-handbag'],
                        ['Crossbody & Slings', '/shop?category=crossbody-slings', 'bi-phone'],
                        ['Office & Work Bags', '/shop?category=office-handbags', 'bi-laptop'],
                    ]],
                    ['TOP BRANDS', [
                        ['Aldo', '/shop?brand=aldo', 'bi-gem'],
                        ['Wrangler Handbags', '/shop?brand=wrangler', 'bi-star'],
                        ['Itti & Emily Loran', '/shop?brand=emily-loran', 'bi-flower1'],
                        ['Magnolia & Sequence', '/shop?brand=magnolia', 'bi-sparkles'],
                        ['Logos Handbags', '/shop?brand=logos', 'bi-bag-check'],
                    ]],
                    ['OCCASIONS', [
                        ['Everyday Carry', '/shop?category=ladies-handbags', 'bi-sun'],
                        ['Party & Festive', '/shop?category=ladies-handbags', 'bi-balloon'],
                        ['Corporate Elegance', '/shop?category=office-handbags', 'bi-briefcase'],
                    ]]
                ]
            ],
            [
                'title' => 'School Bags',
                'type' => 'megamenu',
                'url' => '/shop?category=school-bags',
                'icon' => 'bi-backpack',
                'badge_text' => null,
                'badge_color' => null,
                'sort_order' => 3,
                'columns' => [
                    ['COLLECTION', [
                        ['All School Bags', '/shop?category=school-bags', 'bi-backpack'],
                        ['Ergonomic Spine-Safe', '/shop?category=ergonomic-school-backpacks', 'bi-heart-pulse'],
                        ['College & Laptop Bags', '/shop?category=college-backpacks', 'bi-laptop'],
                        ['Kids Character Bags', '/shop?category=kids-school-bags', 'bi-emoji-smile'],
                        ['Casual Daypacks', '/shop?category=casual-daypacks', 'bi-compass'],
                    ]],
                    ['TRUSTED BRANDS', [
                        ['Safari Back to School', '/shop?brand=safari', 'bi-award'],
                        ['American Tourister Backpacks', '/shop?brand=american-tourister', 'bi-award'],
                        ['Genie Girls Bags', '/shop?brand=genie', 'bi-stars'],
                        ['Swiss Military & Gear', '/shop?brand=gear', 'bi-shield'],
                        ['Tommy Hilfiger Urban', '/shop?brand=tommy-hilfiger', 'bi-patch-check'],
                    ]]
                ]
            ],
            [
                'title' => 'Bridal Purse Collection',
                'type' => 'megamenu',
                'url' => '/shop?category=bridal-purse-collection',
                'icon' => 'bi-stars',
                'badge_text' => 'SPECIAL',
                'badge_color' => '#C59A55',
                'sort_order' => 4,
                'columns' => [
                    ['BRIDAL & WEDDING', [
                        ['All Bridal Purses', '/shop?category=bridal-purse-collection', 'bi-stars'],
                        ['Bridal Wedding Clutches', '/shop?category=bridal-wedding-clutches', 'bi-heart-fill'],
                        ['Handcrafted Potlis', '/shop?category=embroidered-potlis', 'bi-gem'],
                        ['Crystal Evening Purses', '/shop?category=crystal-evening-purses', 'bi-sparkles'],
                        ['Cocktail Box Clutches', '/shop?category=cocktail-box-clutches', 'bi-box'],
                    ]],
                    ['STYLES & FINISHES', [
                        ['Raw Silk & Velvet Zardozi', '/shop?category=bridal-purse-collection', 'bi-brush'],
                        ['Golden Zari & Kundan', '/shop?category=bridal-purse-collection', 'bi-circle-fill'],
                        ['Pearl Encrusted Clutches', '/shop?category=bridal-purse-collection', 'bi-circle'],
                        ['Metallic Gold & Rose', '/shop?category=bridal-purse-collection', 'bi-palette'],
                    ]]
                ]
            ],
            [
                'title' => 'Travel Accessories',
                'type' => 'link',
                'url' => '/shop?category=travel-accessories',
                'icon' => 'bi-compass',
                'badge_text' => null,
                'badge_color' => null,
                'sort_order' => 5,
                'columns' => []
            ],
            [
                'title' => 'About Us (Since 1960)',
                'type' => 'link',
                'url' => '/about',
                'icon' => 'bi-clock-history',
                'badge_text' => 'LEGACY',
                'badge_color' => '#142D4E',
                'sort_order' => 6,
                'columns' => []
            ],
            [
                'title' => 'Contact Store',
                'type' => 'link',
                'url' => '/contact',
                'icon' => 'bi-telephone',
                'badge_text' => null,
                'badge_color' => null,
                'sort_order' => 7,
                'columns' => []
            ],
        ];

        foreach ($menusConfig as $m) {
            $menu = Megamenu::create([
                'title' => $m['title'],
                'type' => $m['type'],
                'url' => $m['url'],
                'icon' => $m['icon'],
                'badge_text' => $m['badge_text'],
                'badge_color' => $m['badge_color'],
                'sort_order' => $m['sort_order'],
                'status' => true,
            ]);

            if ($m['type'] === 'megamenu' && !empty($m['columns'])) {
                foreach ($m['columns'] as $colIdx => [$colTitle, $colItems]) {
                    $column = MegamenuColumn::create([
                        'megamenu_id' => $menu->id,
                        'title' => $colTitle,
                        'sort_order' => $colIdx,
                    ]);

                    foreach ($colItems as $itemIdx => [$itemLabel, $itemUrl, $itemIcon]) {
                        MegamenuItem::create([
                            'column_id' => $column->id,
                            'label' => $itemLabel,
                            'url' => $itemUrl,
                            'icon' => $itemIcon,
                            'sort_order' => $itemIdx,
                            'is_highlighted' => ($itemIdx === 0),
                        ]);
                    }
                }
            }
        }

        // 7. Shipping Methods (INR)
        ShippingMethod::truncate();
        $shippingMethods = [
            ['Standard Surface Shipping', 'Carefully packed & insured delivery within 4-7 business days across India.', 150.00, 1999.00, '4-7 business days'],
            ['Express Air Delivery', 'Priority delivery within 2-3 business days.', 350.00, 4999.00, '2-3 business days'],
            ['Cash on Delivery (COD)', 'Pay cash at your doorstep upon receiving your luggage/bag.', 99.00, null, '4-7 business days'],
            ['Store Pickup (Patiala Store)', 'Collect directly from Durable Suitcase House, Near Anardana Chowk, Dharampura Bazar, Patiala.', 0.00, 0.00, 'Same Day / Ready in 2 hours'],
        ];

        foreach ($shippingMethods as [$name, $desc, $price, $freeAbove, $days]) {
            ShippingMethod::create([
                'name' => $name,
                'description' => $desc,
                'price' => $price,
                'free_above' => $freeAbove,
                'estimated_days' => $days,
                'status' => true,
            ]);
        }

        // 8. Coupons
        Coupon::truncate();
        $coupons = [
            ['DURABLE10', 'percentage', 10, 1500, 500],
            ['LEGACY1960', 'fixed', 500, 3999, 500],
            ['WELCOME5', 'percentage', 5, 999, 300],
        ];

        foreach ($coupons as [$code, $type, $val, $min, $maxDisc]) {
            Coupon::create([
                'code' => $code,
                'type' => $type,
                'value' => $val,
                'min_order_amount' => $min,
                'max_discount_amount' => $maxDisc,
                'status' => true,
            ]);
        }

        // 9. Homepage Sliders
        Slider::truncate();
        $sliders = [
            [
                'title' => 'A Legacy of Trust.<br><em>A Journey Since 1960.</em>',
                'subtitle' => 'DURABLE SUITCASE HOUSE — PATIALA',
                'description' => 'Serving generations with premium luggage, school bags, ladies handbags & exquisite bridal purses under one roof.',
                'image' => 'https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=1600&q=85&fit=crop',
                'button_text' => 'Explore Luggage',
                'button_link' => '/shop?category=luggage',
                'sort_order' => 1,
            ],
            [
                'title' => 'Official Authorized Brands<br><em>American Tourister & Safari</em>',
                'subtitle' => 'UNBREAKABLE TROLLEYS & BAGS',
                'description' => 'Lightweight, stylish, and ultra-durable luggage backed by genuine company warranties for every adventure.',
                'image' => 'https://images.unsplash.com/photo-1581553680321-4fffae59fccd?w=1600&q=85&fit=crop',
                'button_text' => 'Shop Trolleys',
                'button_link' => '/shop?category=hard-trolley-suitcases',
                'sort_order' => 2,
            ],
            [
                'title' => 'Huge Range in Bridal<br><em>& Wedding Purse Collection</em>',
                'subtitle' => 'EXCLUSIVE BRIDAL CLUTCHES & POTLIS',
                'description' => 'Handcrafted zardozi velvet potlis, glittering crystal evening clutches, and luxury designer handbags.',
                'image' => 'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=1600&q=85&fit=crop',
                'button_text' => 'View Bridal Range',
                'button_link' => '/shop?category=bridal-purse-collection',
                'sort_order' => 3,
            ]
        ];

        foreach ($sliders as $s) {
            Slider::create($s + ['status' => true]);
        }
    }
}
