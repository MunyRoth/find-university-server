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
            $table->foreignid('university_type_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name_km');
            $table->string('name_en')
                ->nullable();
            $table->text('about_km');
            $table->text('about_en')
                ->nullable();
            $table->string('logo')
                ->nullable();
            $table->string('website')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->string('phone', 63)
                ->nullable();
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
