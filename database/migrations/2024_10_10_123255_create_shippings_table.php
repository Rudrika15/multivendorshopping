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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('orderItemId');
            $table->integer('storeId');
            $table->string('shippingMethod');
            $table->string('trackingNumber');
            $table->date('shippedDate');
            $table->date('estimateDeliveryDate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropColumn('orderItemId');
            $table->dropColumn('storeId');
            $table->dropColumn('shippingMethod');
            $table->dropColumn('trackingNumber');
            $table->dropColumn('shippedDate');
            $table->dropColumn('estimateDeliveryDate');
        });
    }
};
