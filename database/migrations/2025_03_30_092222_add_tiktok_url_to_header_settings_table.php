<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
   {
       Schema::table('header_settings', function (Blueprint $table) {
           $table->string('tiktok_url')->nullable()->after('zalo_url');
       });
   }

   public function down()
   {
       Schema::table('header_settings', function (Blueprint $table) {
           $table->dropColumn('tiktok_url');
       });
   }
};
