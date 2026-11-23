<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('megamenu_items', 'icon')) {
            Schema::table('megamenu_items', function (Blueprint $table) {
                $table->string('icon', 100)->nullable()->after('url');
            });
        }

        DB::table('megamenus')->whereIn('title', ['Home', 'Shop', 'Blog', 'Pages', 'Contact'])->update(['status' => false]);

        $menus = [
            ['All Jewellery', 'megamenu', '/shop', 'bi-grid-3x3-gap', 1],
            ['Gold', 'megamenu', '/shop?metal_type=gold', 'bi-brightness-high', 2],
            ['Diamond', 'megamenu', '/shop?stone_type=diamond', 'bi-gem', 3],
            ['Earrings', 'link', '/shop?category=earrings', 'bi-stars', 4],
            ['Daily Wear', 'link', '/shop?daily_wear=1', 'bi-journal-bookmark', 5],
            ['Gemstone', 'link', '/shop?stone_type=gemstone', 'bi-circle', 6],
            ['Wedding', 'link', '/shop?occasion=wedding', 'bi-heart', 7],
            ['Gifting', 'link', '/shop?gifting=1', 'bi-gift', 8],
            ['Under 50K', 'link', '/shop?max_price=50000', 'bi-tag', 9],
            ['More', 'dropdown', '/shop', 'bi-three-dots', 10],
        ];

        foreach ($menus as [$title, $type, $url, $icon, $sortOrder]) {
            $menuId = DB::table('megamenus')->where('title', $title)->value('id');
            $values = [
                'type' => $type,
                'url' => $url,
                'icon' => $icon,
                'sort_order' => $sortOrder,
                'status' => true,
                'updated_at' => now(),
            ];

            if ($menuId) {
                DB::table('megamenus')->where('id', $menuId)->update($values);
            } else {
                $menuId = DB::table('megamenus')->insertGetId($values + [
                    'title' => $title,
                    'created_at' => now(),
                ]);
            }

            if ($type !== 'megamenu') {
                continue;
            }

            DB::table('megamenu_columns')->where('megamenu_id', $menuId)->delete();
            $columns = [
                ['Category', [
                    ['All Jewellery', '/shop', 'bi-circle-half'],
                    ['Finger Rings', '/shop?category=rings', 'bi-circle'],
                    ['Nose Pin', '/shop?category=nose-pin', 'bi-triangle'],
                    ['Bangles', '/shop?category=bangles', 'bi-infinity'],
                ]],
                ['Collections', [
                    ['Earrings', '/shop?category=earrings', 'bi-stars'],
                    ['Mangalsutra', '/shop?category=mangalsutra', 'bi-heart'],
                    ['Necklaces', '/shop?category=necklaces', 'bi-gem'],
                    ['Bracelets', '/shop?category=bracelets', 'bi-dash-circle'],
                ]],
                ['More Jewellery', [
                    ['Pendants', '/shop?category=pendants', 'bi-dot'],
                    ['Chains', '/shop?category=chains', 'bi-link-45deg'],
                    ['Necklace Set', '/shop?category=necklace-set', 'bi-record-circle'],
                    ['Pendants & Earring', '/shop?category=sets', 'bi-intersect'],
                ]],
            ];

            foreach ($columns as $columnOrder => [$columnTitle, $items]) {
                $columnId = DB::table('megamenu_columns')->insertGetId([
                    'megamenu_id' => $menuId,
                    'title' => $columnTitle,
                    'sort_order' => $columnOrder,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($items as $itemOrder => [$label, $itemUrl, $itemIcon]) {
                    DB::table('megamenu_items')->insert([
                        'column_id' => $columnId,
                        'label' => $label,
                        'url' => $itemUrl,
                        'icon' => $itemIcon,
                        'is_highlighted' => false,
                        'sort_order' => $itemOrder,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        DB::table('megamenus')->whereIn('title', ['All Jewellery', 'Gold', 'Diamond', 'Earrings', 'Daily Wear', 'Gemstone', 'Wedding', 'Gifting', 'Under 50K', 'More'])->update(['status' => false]);
    }
};
