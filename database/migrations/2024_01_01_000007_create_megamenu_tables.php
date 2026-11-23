<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('megamenus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['link', 'dropdown', 'megamenu'])->default('link');
            $table->string('url', 255)->nullable();
            $table->string('target', 20)->default('_self');
            $table->string('icon', 100)->nullable();
            $table->string('badge_text', 50)->nullable();
            $table->string('badge_color', 50)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('megamenu_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('megamenu_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('megamenu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('column_id')->constrained('megamenu_columns')->onDelete('cascade');
            $table->string('label');
            $table->string('url', 255);
            $table->boolean('is_highlighted')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('megamenu_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('megamenu_id')->constrained()->onDelete('cascade');
            $table->string('image', 255);
            $table->string('title')->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('megamenu_banners');
        Schema::dropIfExists('megamenu_items');
        Schema::dropIfExists('megamenu_columns');
        Schema::dropIfExists('megamenus');
    }
};
