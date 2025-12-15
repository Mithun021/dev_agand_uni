<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('course_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('branch_id');
            $table->enum('course_type', ['semester', 'annual']);
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('scheme_id')->nullable();
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('annual_id')->nullable();
            $table->enum('subject_type',['theory','practical']);
            $table->string('subject_code');
            $table->string('subject_name');
            $table->unsignedBigInteger('credit');
            $table->unsignedBigInteger('internal_marks');
            $table->unsignedBigInteger('external_marks');
            $table->unsignedBigInteger('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_subjects');
    }
};
