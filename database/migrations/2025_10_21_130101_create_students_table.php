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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Student details
            $table->string('university_roll_no')->unique();
            $table->string('reg_no')->nullable();
            $table->string('student_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('abcid')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();
            $table->string('aadhar', 12)->nullable();
            $table->text('current_address')->nullable();
            $table->text('parmanent_address')->nullable(); // Typo kept same if consistent
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('category')->nullable();

            // College info
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();

            // Media
            $table->string('profile_image')->nullable();
            $table->string('signature')->nullable();

            // Password
            $table->string('password')->nullable();
            $table->rememberToken();

            // Foreign keys
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained()->cascadeOnDelete();
            $table->foreignId('scheme_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained('batches')->cascadeOnDelete();

            $table->enum('pursuing_status', ['yes', 'no'])->default('yes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
