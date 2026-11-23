<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $content = <<<'HTML'
<h2>Crafting Brilliance Since 2005</h2>
<p>Pacific Diamonds was born from a passion for exquisite craftsmanship and a belief that every person deserves jewelry that tells their unique story.</p>
<p><a href="/shop">Explore Collection</a> &nbsp; <a href="/contact">Contact Us</a></p>

<h2>Our Achievements</h2>
<ul>
  <li><strong>18+</strong> Years of Excellence</li>
  <li><strong>50,000+</strong> Happy Customers</li>
  <li><strong>5,000+</strong> Unique Designs</li>
  <li><strong>100%</strong> Certified Genuine</li>
</ul>

<h2>Our Story</h2>
<h3>A Journey of Passion and Precision</h3>
<p>Pacific Diamonds began in 2005 with a single vision: to create jewelry that goes beyond adornment and becomes a cherished part of life's most precious moments. Founded by master jeweler Ahmed Khan in the heart of Karachi, we started as a small atelier with big dreams.</p>
<p>Today, we are one of Pakistan's most trusted diamond jewelry brands, serving customers across the country with our signature blend of traditional craftsmanship and contemporary design. Every piece we create is a testament to our unwavering commitment to quality.</p>
<p><strong>Certified Diamonds</strong> | <strong>Master Craftsmen</strong> | <strong>Customer First</strong></p>

<h2>Our Mission and Values</h2>
<h3>Our Mission</h3>
<p>To craft timeless jewelry that celebrates life's most precious moments, using only the finest certified diamonds and ethically sourced materials.</p>
<h3>Our Vision</h3>
<p>To be the most trusted and beloved jewelry brand in Pakistan, known for uncompromising quality, innovative design, and exceptional customer experience.</p>
<h3>Quality First</h3>
<p>Every diamond we source is GIA-certified. Every metal is hallmarked. Every piece is inspected by our master craftsmen before it reaches you.</p>
<h3>Customer Care</h3>
<p>Your satisfaction is our priority. From personalized consultations to after-sales service, we are with you every step of the way.</p>
<h3>Ethical Sourcing</h3>
<p>We are committed to responsible sourcing. All our diamonds are conflict-free, and we maintain transparent supply chains from mine to market.</p>
<h3>Community</h3>
<p>We believe in giving back. A portion of every sale supports artisan training programs and community development initiatives.</p>

<h2>Milestones and Achievements</h2>
<h3>2005 - The Beginning</h3><p>Ahmed Khan opens Pacific Diamonds as a small jewelry atelier in Karachi with a team of five master craftsmen.</p>
<h3>2008 - First Collection Launch</h3><p>Our debut Ocean Series diamond collection sells out within weeks, establishing our reputation for quality.</p>
<h3>2012 - Expansion</h3><p>We open our flagship showroom and launch our bridal jewelry line, quickly becoming a top choice for weddings.</p>
<h3>2015 - Digital Presence</h3><p>Pacific Diamonds launches its e-commerce platform, bringing our collection to customers nationwide.</p>
<h3>2019 - International Recognition</h3><p>Awarded Best Jewelry Brand at the Pakistan Gemstone and Jewelry Development Company awards.</p>
<h3>2023 - Certified Excellence</h3><p>All diamonds sourced are now 100% GIA-certified, reinforcing our commitment to quality and transparency.</p>

<h2>Meet Our Team</h2>
<ul>
  <li><strong>Ahmed Khan</strong> - Founder and Master Jeweler</li>
  <li><strong>Sara Malik</strong> - Head of Design</li>
  <li><strong>Usman Qureshi</strong> - Chief Gemologist</li>
  <li><strong>Ayesha Raza</strong> - Customer Relations</li>
</ul>

<h2>Why Choose Pacific Diamonds?</h2>
<h3>GIA Certified</h3><p>Every diamond comes with a GIA certificate guaranteeing its authenticity, cut, clarity, and carat weight.</p>
<h3>Master Crafted</h3><p>Each piece is handcrafted by our expert jewelers with decades of experience in fine jewelry making.</p>
<h3>Free Delivery</h3><p>We offer free nationwide shipping on all orders with secure, insured packaging for every piece.</p>
<h3>30-Day Returns</h3><p>Shop with confidence. If you are not completely satisfied, we offer hassle-free returns within 30 days.</p>

<p><a href="/shop">Shop Our Collection</a></p>
HTML;

        DB::table('pages')->updateOrInsert(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'content' => $content,
                'meta_title' => 'About Us - Pacific Diamonds',
                'meta_description' => 'Learn about Pacific Diamonds, our story, mission, craftsmanship, and commitment to exceptional jewelry.',
                'status' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        DB::table('pages')->where('slug', 'about')->delete();
    }
};
