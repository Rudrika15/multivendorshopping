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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('storeName');
            $table->string('contactNo');
            $table->string('logo');
            $table->text('address');
            $table->string('city');
            $table->integer('userId');
            $table->integer('pincode');
            $table->string('landmark');
            $table->string('aadharCardNo');
            $table->string('panCardNo');
            $table->string('gstNo');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum('status', ['Active', 'Deactive'])->default('Active');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
