<?php

use App\Models\Megamenu;
use App\Models\MegamenuColumn;
use App\Models\MegamenuItem;
use App\Models\Brand;
use App\Models\Category;

// 1. Ensure all Brands from handwriting note exist with proper names and slugs
$brandData = [
    // Luggage Brands
    ['name' => 'American Tourister', 'slug' => 'american-tourister'],
    ['name' => 'Samsonite', 'slug' => 'samsonite'],
    ['name' => 'Kamiliant', 'slug' => 'kamiliant'],
    ['name' => 'Safari', 'slug' => 'safari'],
    ['name' => 'VIP', 'slug' => 'vip'],
    ['name' => 'Swiss Military', 'slug' => 'swiss-military'],
    ['name' => 'Gear', 'slug' => 'gear'],
    ['name' => 'Aristocrat', 'slug' => 'aristocrat'],
    ['name' => 'Tommy Hilfiger', 'slug' => 'tommy-hilfiger'],
    ['name' => 'Delsey Paris', 'slug' => 'delsey-paris'],

    // Ladies Handbags Brands
    ['name' => 'Wrangler', 'slug' => 'wrangler'],
    ['name' => 'Itti', 'slug' => 'itti'],
    ['name' => 'Aldo', 'slug' => 'aldo'],
    ['name' => 'Magnolia', 'slug' => 'magnolia'],
    ['name' => 'Sequence', 'slug' => 'sequence'],
    ['name' => 'Logos', 'slug' => 'logos'],
    ['name' => 'Emily Loran', 'slug' => 'emily-loran'],

    // School Bags Brands
    ['name' => 'Genie', 'slug' => 'genie'],
];

foreach ($brandData as $b) {
    Brand::updateOrCreate(
        ['slug' => $b['slug']],
        ['name' => $b['name'], 'status' => true]
    );
}

// 2. Clear old megamenus safely with foreign keys disabled
\Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
MegamenuItem::truncate();
MegamenuColumn::truncate();
Megamenu::truncate();
\Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

// --- MENU 1: Luggage ---
$luggage = Megamenu::create([
    'title' => 'Luggage',
    'type' => 'megamenu',
    'url' => '/shop?category=luggage',
    'target' => '_self',
    'icon' => 'bi-suitcase-lg',
    'badge_text' => 'POPULAR',
    'badge_color' => '#142D4E',
    'sort_order' => 1,
    'status' => true,
]);

$colLug1 = MegamenuColumn::create([
    'megamenu_id' => $luggage->id,
    'title' => 'AUTHORIZED BRANDS',
    'sort_order' => 0,
]);
$luggageBrands = [
    'American Tourister' => 'american-tourister',
    'Samsonite' => 'samsonite',
    'Kamiliant' => 'kamiliant',
    'Safari' => 'safari',
    'VIP' => 'vip',
];
foreach ($luggageBrands as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colLug1->id,
        'label' => $name,
        'url' => '/shop?brand=' . $slug,
        'icon' => 'bi-patch-check-fill',
        'is_highlighted' => true,
        'sort_order' => 0,
    ]);
}

$colLug2 = MegamenuColumn::create([
    'megamenu_id' => $luggage->id,
    'title' => 'PREMIUM & TRAVEL BRANDS',
    'sort_order' => 1,
]);
$luggageBrands2 = [
    'Swiss Military' => 'swiss-military',
    'Gear' => 'gear',
    'Aristocrat' => 'aristocrat',
    'Tommy Hilfiger' => 'tommy-hilfiger',
    'Delsey Paris' => 'delsey-paris',
];
foreach ($luggageBrands2 as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colLug2->id,
        'label' => $name,
        'url' => '/shop?brand=' . $slug,
        'icon' => 'bi-shield-check',
        'is_highlighted' => false,
        'sort_order' => 0,
    ]);
}

$colLug3 = MegamenuColumn::create([
    'megamenu_id' => $luggage->id,
    'title' => 'LUGGAGE CATEGORIES',
    'sort_order' => 2,
]);
$luggageCats = [
    'Hard Trolley Suitcases' => 'hard-trolley-suitcases',
    'Soft Luggage & Spinners' => 'soft-luggage',
    'Cabin Luggage (Airline Approved)' => 'cabin-luggage',
    'Travel Duffle Bags' => 'travel-duffle-bags',
    'View All Luggage' => 'luggage',
];
foreach ($luggageCats as $label => $cslug) {
    MegamenuItem::create([
        'column_id' => $colLug3->id,
        'label' => $label,
        'url' => '/shop?category=' . $cslug,
        'icon' => 'bi-arrow-right-circle',
        'is_highlighted' => ($cslug === 'luggage'),
        'sort_order' => 0,
    ]);
}


// --- MENU 2: Ladies Handbags ---
$handbags = Megamenu::create([
    'title' => 'Ladies Handbags',
    'type' => 'megamenu',
    'url' => '/shop?category=ladies-handbags',
    'target' => '_self',
    'icon' => 'bi-handbag',
    'badge_text' => 'TRENDING',
    'badge_color' => '#C59A55',
    'sort_order' => 2,
    'status' => true,
]);

$colHand1 = MegamenuColumn::create([
    'megamenu_id' => $handbags->id,
    'title' => 'FEATURED BRANDS',
    'sort_order' => 0,
]);
$handbagBrands1 = [
    'Wrangler' => 'wrangler',
    'Itti' => 'itti',
    'Aldo' => 'aldo',
    'Magnolia' => 'magnolia',
];
foreach ($handbagBrands1 as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colHand1->id,
        'label' => $name,
        'url' => '/shop?brand=' . $slug,
        'icon' => 'bi-stars',
        'is_highlighted' => true,
        'sort_order' => 0,
    ]);
}

$colHand2 = MegamenuColumn::create([
    'megamenu_id' => $handbags->id,
    'title' => 'DESIGNER BRANDS',
    'sort_order' => 1,
]);
$handbagBrands2 = [
    'Sequence' => 'sequence',
    'Logos' => 'logos',
    'Emily Loran' => 'emily-loran',
    'Explore All Brands' => '',
];
foreach ($handbagBrands2 as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colHand2->id,
        'label' => $name,
        'url' => $slug ? '/shop?brand=' . $slug : '/shop?category=ladies-handbags',
        'icon' => 'bi-gem',
        'is_highlighted' => false,
        'sort_order' => 0,
    ]);
}

$colHand3 = MegamenuColumn::create([
    'megamenu_id' => $handbags->id,
    'title' => 'HANDBAG STYLES',
    'sort_order' => 2,
]);
$handbagCats = [
    'Tote Bags' => 'tote-bags',
    'Shoulder Bags' => 'shoulder-bags',
    'Crossbody & Slings' => 'crossbody-slings',
    'Office & Laptop Handbags' => 'office-handbags',
    'All Ladies Handbags' => 'ladies-handbags',
];
foreach ($handbagCats as $label => $cslug) {
    MegamenuItem::create([
        'column_id' => $colHand3->id,
        'label' => $label,
        'url' => '/shop?category=' . $cslug,
        'icon' => 'bi-arrow-right-circle',
        'is_highlighted' => ($cslug === 'ladies-handbags'),
        'sort_order' => 0,
    ]);
}


// --- MENU 3: School Bags ---
$schoolBags = Megamenu::create([
    'title' => 'School Bags',
    'type' => 'megamenu',
    'url' => '/shop?category=school-bags',
    'target' => '_self',
    'icon' => 'bi-backpack',
    'badge_text' => null,
    'badge_color' => null,
    'sort_order' => 3,
    'status' => true,
]);

$colSch1 = MegamenuColumn::create([
    'megamenu_id' => $schoolBags->id,
    'title' => 'OFFICIAL SCHOOL BRANDS',
    'sort_order' => 0,
]);
$schoolBrands1 = [
    'Safari' => 'safari',
    'American Tourister' => 'american-tourister',
    'Genie' => 'genie',
    'Kamiliant' => 'kamiliant',
];
foreach ($schoolBrands1 as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colSch1->id,
        'label' => $name,
        'url' => '/shop?brand=' . $slug,
        'icon' => 'bi-award-fill',
        'is_highlighted' => true,
        'sort_order' => 0,
    ]);
}

$colSch2 = MegamenuColumn::create([
    'megamenu_id' => $schoolBags->id,
    'title' => 'DURABLE & BACKPACK BRANDS',
    'sort_order' => 1,
]);
$schoolBrands2 = [
    'Gear' => 'gear',
    'Tommy Hilfiger' => 'tommy-hilfiger',
    'Swiss Military' => 'swiss-military',
    'View All Backpack Brands' => '',
];
foreach ($schoolBrands2 as $name => $slug) {
    MegamenuItem::create([
        'column_id' => $colSch2->id,
        'label' => $name,
        'url' => $slug ? '/shop?brand=' . $slug : '/shop?category=school-bags',
        'icon' => 'bi-shield-fill-check',
        'is_highlighted' => false,
        'sort_order' => 0,
    ]);
}

$colSch3 = MegamenuColumn::create([
    'megamenu_id' => $schoolBags->id,
    'title' => 'AGE & USE TYPES',
    'sort_order' => 2,
]);
$schoolCats = [
    'Ergonomic School Backpacks' => 'ergonomic-school-backpacks',
    'College & Laptop Backpacks' => 'college-backpacks',
    'Kids Character Bags' => 'kids-school-bags',
    'Casual Daypacks' => 'casual-daypacks',
    'All School & College Bags' => 'school-bags',
];
foreach ($schoolCats as $label => $cslug) {
    MegamenuItem::create([
        'column_id' => $colSch3->id,
        'label' => $label,
        'url' => '/shop?category=' . $cslug,
        'icon' => 'bi-arrow-right-circle',
        'is_highlighted' => ($cslug === 'school-bags'),
        'sort_order' => 0,
    ]);
}


// --- MENU 4: Bridal Purse Collection ---
$bridal = Megamenu::create([
    'title' => 'Bridal Purse Collection',
    'type' => 'megamenu',
    'url' => '/shop?category=bridal-purse-collection',
    'target' => '_self',
    'icon' => 'bi-stars',
    'badge_text' => 'HUGE RANGE',
    'badge_color' => '#C59A55',
    'sort_order' => 4,
    'status' => true,
]);

$colBridal1 = MegamenuColumn::create([
    'megamenu_id' => $bridal->id,
    'title' => 'BRIDAL PURSE COLLECTION',
    'sort_order' => 0,
]);
$bridalCats = [
    'Bridal Wedding Clutches' => 'bridal-wedding-clutches',
    'Embroidered Potlis' => 'embroidered-potlis',
    'Crystal & Stone Evening Purses' => 'crystal-evening-purses',
    'Cocktail Box Clutches' => 'cocktail-box-clutches',
    'Explore Full Bridal Range' => 'bridal-purse-collection',
];
foreach ($bridalCats as $label => $cslug) {
    MegamenuItem::create([
        'column_id' => $colBridal1->id,
        'label' => $label,
        'url' => '/shop?category=' . $cslug,
        'icon' => 'bi-stars',
        'is_highlighted' => ($cslug === 'bridal-purse-collection'),
        'sort_order' => 0,
    ]);
}

$colBridal2 = MegamenuColumn::create([
    'megamenu_id' => $bridal->id,
    'title' => 'CRAFTSMANSHIP & STYLES',
    'sort_order' => 1,
]);
$bridalStyles = [
    'Handcrafted Zardozi Velvet' => '/shop?category=bridal-purse-collection',
    'Raw Silk Traditional Potlis' => '/shop?category=embroidered-potlis',
    'Pearl Encrusted Clutches' => '/shop?category=bridal-wedding-clutches',
    'Metallic Gold & Rose Gold Box Clutches' => '/shop?category=cocktail-box-clutches',
    'Wedding Guest Party Clutches' => '/shop?category=crystal-evening-purses',
];
foreach ($bridalStyles as $label => $url) {
    MegamenuItem::create([
        'column_id' => $colBridal2->id,
        'label' => $label,
        'url' => $url,
        'icon' => 'bi-gem',
        'is_highlighted' => false,
        'sort_order' => 0,
    ]);
}

// --- MENU 5: About Us ---
Megamenu::create([
    'title' => 'About Us (Since 1960)',
    'type' => 'link',
    'url' => '/about',
    'target' => '_self',
    'icon' => 'bi-clock-history',
    'badge_text' => 'SINCE 1960',
    'badge_color' => '#142D4E',
    'sort_order' => 5,
    'status' => true,
]);

// --- MENU 6: Contact Store ---
Megamenu::create([
    'title' => 'Contact Store',
    'type' => 'link',
    'url' => '/contact',
    'target' => '_self',
    'icon' => 'bi-telephone',
    'badge_text' => null,
    'badge_color' => null,
    'sort_order' => 6,
    'status' => true,
]);

echo "Successfully updated categories and megamenus strictly according to productcategorytinfor.png\n";
