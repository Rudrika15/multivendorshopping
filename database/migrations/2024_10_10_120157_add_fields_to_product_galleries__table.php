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
        Schema::table('product_galleries', function (Blueprint $table) {
            $table->integer('productId');
            $table->string('imageURL');
            $table->string('IsPrimary');
            $table->string('altText');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_galleries', function (Blueprint $table) {
            $table->dropColumn('productId');
            $table->dropColumn('imageURL');
            $table->dropColumn('IsPrimary');
            $table->dropColumn('altText');
        });
    }
};
