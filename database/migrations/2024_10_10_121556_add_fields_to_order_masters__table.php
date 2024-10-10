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
        Schema::table('order_masters', function (Blueprint $table) {
            $table->string('orderStatus');
            $table->string('shippingAddress');
            $table->string('paymentMethod');
            $table->integer('totalAmount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_masters', function (Blueprint $table) {
            $table->dropColumn('orderStatus');
            $table->dropColumn('shippingAddress');
            $table->dropColumn('paymentMethod');
            $table->dropColumn('totalAmount');
        });
    }
};
