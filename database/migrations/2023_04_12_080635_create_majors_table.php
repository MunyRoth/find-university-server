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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->foreignid('department_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignid('major_type_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name_km');
            $table->string('name_en')
                ->nullable();
            $table->integer('num_semesters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
