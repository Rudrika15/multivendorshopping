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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('productVariantId');
            $table->string('quantity');
            $table->integer('price');
            $table->integer('storeId');
            $table->integer('userId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('productVariantId');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('storeId');
            $table->dropColumn('userId');

        });
    }
};
