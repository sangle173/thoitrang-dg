<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('slug');
        });

        // Set default user ID (1) for existing records
        DB::table('portfolios')->update(['created_by' => 1]);
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
};
