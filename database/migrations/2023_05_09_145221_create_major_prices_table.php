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
        Schema::create('major_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignid('major_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('price_khr', 15)
                ->nullable();
            $table->string('price_usd', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('major_prices');
    }
};
