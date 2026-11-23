<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $pages = [
            ['About Us', 'about', '<h2>Our Story</h2><p>Tell your customers about your brand, story, and values from Admin &gt; Pages.</p>'],
            ['Terms & Conditions', 'terms', '<h2>Terms &amp; Conditions</h2><p>Publish your store terms and conditions here.</p>'],
            ['Privacy Policy', 'privacy', '<h2>Privacy Policy</h2><p>Publish your privacy policy here.</p>'],
            ['Refund Policy', 'refund', '<h2>Refund Policy</h2><p>Publish your refund and return policy here.</p>'],
        ];

        foreach ($pages as [$title, $slug, $content]) {
            DB::table('pages')->updateOrInsert(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'content' => $content,
                    'meta_title' => $title . ' — Pacific Diamonds',
                    'status' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('pages')->whereIn('slug', ['about', 'terms', 'privacy', 'refund'])->delete();
    }
};