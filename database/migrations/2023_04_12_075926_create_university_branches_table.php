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
        Schema::create('university_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('province_id')
                ->constrained()
                ->onDelete('cascade');
            $table->text('address_km');
            $table->text('address_en')
                ->nullable();
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_branches');
    }
};
