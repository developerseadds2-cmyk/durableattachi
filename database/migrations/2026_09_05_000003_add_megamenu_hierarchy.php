<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('megamenus', 'parent_id')) {
            Schema::table('megamenus', function (Blueprint $table) {
                $table->foreignId('parent_id')->nullable()->after('badge_color')->constrained('megamenus')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('megamenus', 'parent_id')) {
            Schema::table('megamenus', function (Blueprint $table) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            });
        }
    }
};