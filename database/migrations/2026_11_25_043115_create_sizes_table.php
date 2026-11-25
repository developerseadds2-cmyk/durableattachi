<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create sizes table
        if (!Schema::hasTable('sizes')) {
            Schema::create('sizes', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // e.g. Cabin (55 cm), Medium (65 cm), Large (75 cm), 32 L
                $table->string('code')->nullable(); // e.g. 55CM, S, M, L, XL
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        // 2. Add size_id to products table
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'size_id')) {
                $table->foreignId('size_id')->nullable()->after('color_id')->constrained('sizes')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['size_id']);
            $table->dropColumn('size_id');
        });

        Schema::dropIfExists('sizes');
    }
};
