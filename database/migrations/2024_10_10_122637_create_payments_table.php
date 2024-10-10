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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('orderId');
            $table->string('paymentMethod');
            $table->string('paymentstatus');
            $table->string('amountPaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('orderId');
            $table->dropColumn('paymentMethod');
            $table->dropColumn('paymentstatus');
            $table->dropColumn('amountPaid');


        });
    }
};
