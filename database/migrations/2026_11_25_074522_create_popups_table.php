<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('offer'); // 'offer' (with discount/coupon) or 'simple' (announcement, notice, welcome)
            $table->string('badge_text')->nullable(); // e.g. "SPECIAL OFFER", "EXCLUSIVE DEAL", "STORE NOTICE"
            $table->string('headline')->nullable(); // e.g. "Get 15% Off Luggage & Handbags"
            $table->text('description')->nullable(); // Body message
            $table->string('coupon_code')->nullable(); // e.g. "SUMMER15"
            $table->integer('discount_percentage')->nullable(); // e.g. 15
            $table->string('button_text')->nullable()->default('Shop Now');
            $table->string('button_url')->nullable()->default('/shop');
            $table->string('image')->nullable();
            
            // Targeting & Display rules
            $table->string('target_type')->default('all'); // 'all', 'home_only', 'category', 'product'
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            
            $table->integer('delay_seconds')->default(2); // show after N seconds
            $table->boolean('show_once_per_session')->default(true); // Don't annoy user on every refresh
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popups');
    }
};
