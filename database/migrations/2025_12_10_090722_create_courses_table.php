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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course')->unique();
            $table->enum('course_type', ['Semester', 'Annual']);
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('annual_id')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->boolean('is_active')->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
