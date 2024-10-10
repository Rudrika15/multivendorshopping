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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contactno');
            $table->string('logo');
            $table->string('address');
            $table->string('city');
            $table->integer('userId');
            $table->string('pincode');
            $table->string('landmark');
            $table->string('aadharCardNo');
            $table->string('panCardNo');
            $table->string('gst');
            $table->string('ratings');
            $table->string('storeDescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('contactno');
            $table->dropColumn('logo');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('userId');
            $table->dropColumn('pincode');
            $table->dropColumn('landmark');
            $table->dropColumn('aadharCardNo');
            $table->dropColumn('panCardNo');
            $table->dropColumn('gst');
            $table->dropColumn('ratings');
            $table->dropColumn('storeDescription');

        });
    }
};
