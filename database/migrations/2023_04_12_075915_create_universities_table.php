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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->foreignid('university_type_id')->references('id')->on('university_types');
            $table->string('name_km');
            $table->string('name_en');
            $table->string('about_km');
            $table->string('about_en');
            $table->json('logo');
            $table->string('website');
            $table->string('email');
            $table->string('phone');
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
