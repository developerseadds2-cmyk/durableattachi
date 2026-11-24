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
        // 1. Create colors master table
        if (!Schema::hasTable('colors')) {
            Schema::create('colors', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // e.g. Silver, Midnight Blue, Jet Black, Rose Gold
                $table->string('code')->nullable(); // Hex code e.g. #C0C0C0
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        // 2. Add luggage/suitcase fields to products table
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'color_id')) {
                $table->foreignId('color_id')->nullable()->after('brand_id')->constrained('colors')->nullOnDelete();
            }
            if (!Schema::hasColumn('products', 'warranty_details')) {
                $table->string('warranty_details')->nullable()->after('material'); // e.g. "5 years international warranty"
            }
            if (!Schema::hasColumn('products', 'product_warranty')) {
                $table->string('product_warranty')->nullable()->after('warranty_details'); // e.g. "5 Years"
            }
            if (!Schema::hasColumn('products', 'manufacturer_details')) {
                $table->text('manufacturer_details')->nullable()->after('product_warranty'); // e.g. "DGP House, 5th Floor..."
            }
            if (!Schema::hasColumn('products', 'tax_rate')) {
                $table->decimal('tax_rate', 5, 2)->default(18.00)->after('manufacturer_details'); // e.g. 18.00%
            }
            if (!Schema::hasColumn('products', 'hsn_code')) {
                $table->string('hsn_code', 50)->default('42021250')->after('tax_rate'); // e.g. 42021250
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn([
                'color_id',
                'warranty_details',
                'product_warranty',
                'manufacturer_details',
                'tax_rate',
                'hsn_code',
            ]);
        });

        Schema::dropIfExists('colors');
    }
};
