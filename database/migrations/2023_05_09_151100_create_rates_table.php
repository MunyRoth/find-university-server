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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignid('university_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('rate');
            $table->boolean('is_pending')
                ->default(config('settings.default_is_pending'));
            $table->boolean('is_approved')
                ->default(config('settings.default_is_approved'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
