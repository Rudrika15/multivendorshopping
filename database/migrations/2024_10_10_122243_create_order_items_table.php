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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('productVariantId');
            $table->integer('storeId');
            $table->string('quantity');
            $table->integer('price');
            $table->string('shippedStatus');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('productId');
            $table->dropColumn('productVariantId');
            $table->dropColumn('storeId');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('shippedStatus');

        });
    }
};
