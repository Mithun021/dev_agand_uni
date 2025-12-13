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
        Schema::create('course_assign_curriculams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('branch_id');
            $table->enum('course_type', ['semester', 'annual']);
            $table->json('session_id')->nullable();
            $table->json('scheme_id')->nullable();
            $table->json('institute_id')->nullable();
            $table->json('semester_id')->nullable();
            $table->json('annual_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_assign_curriculams');
    }
};
