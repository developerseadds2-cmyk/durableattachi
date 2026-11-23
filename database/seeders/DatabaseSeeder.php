<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Megamenu;
use App\Models\MegamenuColumn;
use App\Models\MegamenuItem;
use App\Models\ShippingMethod;
use App\Models\Coupon;
use App\Models\Page;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(['email' => 'admin@glamora.com'], [
            'name'     => 'Admin',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'status'   => true,
        ]);

        // Customer
        User::firstOrCreate(['email' => 'customer@glamora.com'], [
            'name'     => 'Demo Customer',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'status'   => true,
        ]);

        // Settings
        $settings = [
            ['site_name',           'Glamora Jewelry',              'general'],
            ['site_email',          'info@glamora.com',             'general'],
            ['site_phone',          '+92-300-1234567',              'general'],
            ['site_address',        '123 Jewelry Street, Karachi',  'general'],
            ['currency',            'PKR',                          'general'],
            ['currency_symbol',     '₨',                            'general'],
            ['free_shipping_above', '5000',                         'general'],
            ['tax_rate',            '0',                            'general'],
            ['meta_title',          'Glamora — Premium Jewelry Store', 'seo'],
            ['meta_description',    'Shop the finest jewelry at Glamora', 'seo'],
            ['stripe_key',          '',                             'payment'],
            ['stripe_secret',       '',                             'payment'],
            ['paypal_client_id',    '',                             'payment'],
            ['paypal_secret',       '',                             'payment'],
            ['paypal_mode',         'sandbox',                      'payment'],
            ['cod_enabled',         '1',                            'payment'],
        ];

        foreach ($settings as [$key, $value, $group]) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }

        // Managed static pages
        $pages = [
            ['About Us', 'about', '<h2>Our Story</h2><p>Tell your customers about your brand, story, and values from Admin &gt; Pages.</p>'],
            ['Terms & Conditions', 'terms', '<h2>Terms &amp; Conditions</h2><p>Publish your store terms and conditions here.</p>'],
            ['Privacy Policy', 'privacy', '<h2>Privacy Policy</h2><p>Publish your privacy policy here.</p>'],
            ['Refund Policy', 'refund', '<h2>Refund Policy</h2><p>Publish your refund and return policy here.</p>'],
        ];

        foreach ($pages as [$title, $slug, $content]) {
            Page::firstOrCreate(['slug' => $slug], [
                'title' => $title,
                'content' => $content,
                'meta_title' => $title . ' — Pacific Diamonds',
                'status' => true,
            ]);
        }

        // Categories
        $parentCats = [
            ['Earrings', 'earrings', 1],
            ['Rings', 'rings', 2],
            ['Necklaces', 'necklaces', 3],
            ['Bracelets', 'bracelets', 4],
        ];

        $parentIds = [];
        foreach ($parentCats as [$name, $slug, $order]) {
            $cat = Category::firstOrCreate(['slug' => $slug], [
                'name' => $name, 'sort_order' => $order, 'status' => true,
            ]);
            $parentIds[$slug] = $cat->id;
        }

        $childCats = [
            ['Stone Collection', 'stone-collection', $parentIds['earrings'], 1],
            ['Pearls Earrings', 'pearls-earrings', $parentIds['earrings'], 2],
            ['Traditional', 'traditional-earrings', $parentIds['earrings'], 3],
            ['Gold Rings', 'gold-rings', $parentIds['rings'], 1],
            ['Diamond Rings', 'diamond-rings', $parentIds['rings'], 2],
            ['Platinum Rings', 'platinum-rings', $parentIds['rings'], 3],
            ['Diamond Necklace', 'diamond-necklace', $parentIds['necklaces'], 1],
            ['Wedding Set', 'wedding-set', $parentIds['necklaces'], 2],
        ];

        foreach ($childCats as [$name, $slug, $parentId, $order]) {
            Category::firstOrCreate(['slug' => $slug], [
                'name' => $name, 'parent_id' => $parentId, 'sort_order' => $order, 'status' => true,
            ]);
        }

        // Megamenu
        $menus = [
            ['Home',    'link',     '/',      null,     null,       1],
            ['Shop',    'megamenu', '/shop',  null,     null,       2],
            ['Blog',    'link',     '/blog',  'NEW',    '#c9a96e',  3],
            ['Pages',   'dropdown', '/pages', null,     null,       4],
            ['Contact', 'link',     '/contact', null,  null,       5],
        ];

        foreach ($menus as [$title, $type, $url, $badge, $color, $order]) {
            $menu = Megamenu::firstOrCreate(['title' => $title], [
                'type' => $type, 'url' => $url,
                'badge_text' => $badge, 'badge_color' => $color,
                'sort_order' => $order, 'status' => true,
            ]);

            if ($menu->title === 'Shop' && $menu->columns()->count() === 0) {
                $cols = [
                    ['EARRINGS', [
                        ['Stone Collection', '/shop/stone-collection', false],
                        ['Pearls Earrings', '/shop/pearls-earrings', false],
                        ['Fashionable', '/shop/fashionable-earrings', false],
                        ['Traditional', '/shop/traditional-earrings', true],
                        ['Trending', '/shop/trending-earrings', false],
                        ['Platinum', '/shop/platinum-earrings', false],
                    ]],
                    ['RINGS', [
                        ['Gold Rings', '/shop/gold-rings', false],
                        ['Platinum Rings', '/shop/platinum-rings', false],
                        ['Diamond Rings', '/shop/diamond-rings', false],
                        ['Gemstone Rings', '/shop/gemstone-rings', false],
                        ['Rose Gold Rings', '/shop/rose-gold-rings', false],
                        ['Yellow Gold Ring', '/shop/yellow-gold-ring', false],
                    ]],
                    ['NECKLACES', [
                        ['Antique Design', '/shop/antique-necklace', false],
                        ['Fashionable Design', '/shop/fashionable-necklace', true],
                        ['Diamond Necklace', '/shop/diamond-necklace', false],
                        ['Wedding Set', '/shop/wedding-set', false],
                        ['Vintage Necklace', '/shop/vintage-necklace', false],
                        ['Party Necklace', '/shop/party-necklace', false],
                    ]],
                ];

                foreach ($cols as $idx => [$colTitle, $items]) {
                    $col = $menu->columns()->create(['title' => $colTitle, 'sort_order' => $idx]);
                    foreach ($items as $order2 => [$label, $url2, $highlighted]) {
                        $col->items()->create(['label' => $label, 'url' => $url2, 'is_highlighted' => $highlighted, 'sort_order' => $order2]);
                    }
                }
            }
        }

        // Shipping Methods
        $shipping = [
            ['Standard Shipping', 'Delivery in 5-7 business days', 200, 5000, '5-7 days'],
            ['Express Shipping', 'Delivery in 2-3 business days', 400, null, '2-3 days'],
            ['Cash on Delivery', 'Pay when you receive', 150, null, '5-7 days'],
        ];
        foreach ($shipping as [$name, $desc, $price, $free, $days]) {
            ShippingMethod::firstOrCreate(['name' => $name], [
                'description' => $desc, 'price' => $price, 'free_above' => $free, 'estimated_days' => $days, 'status' => true,
            ]);
        }

        // Coupons
        $coupons = [
            ['GLAMORA10', 'percentage', 10, 1000],
            ['WELCOME15', 'percentage', 15, 2000],
            ['FLAT500', 'fixed', 500, 3000],
        ];
        foreach ($coupons as [$code, $type, $val, $min]) {
            Coupon::firstOrCreate(['code' => $code], [
                'type' => $type, 'value' => $val, 'min_order_amount' => $min, 'status' => true,
            ]);
        }
    }
}
