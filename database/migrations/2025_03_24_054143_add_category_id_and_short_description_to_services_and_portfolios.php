<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedBigInteger('service_category_id')->nullable()->after('id');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->nullOnDelete();
            $table->text('short_description')->nullable()->after('service_category_id');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->unsignedBigInteger('portfolio_category_id')->nullable()->after('id');
            $table->foreign('portfolio_category_id')->references('id')->on('portfolio_categories')->nullOnDelete();
            $table->text('short_description')->nullable()->after('portfolio_category_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services_and_portfolios', function (Blueprint $table) {
            //
        });
    }
};
