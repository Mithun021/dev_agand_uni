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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained()->cascadeOnDelete();
            $table->foreignId('scheme_id')->constrained()->cascadeOnDelete();

            // Subject details
            $table->string('name');
            $table->enum('type', ['Theory', 'Practical'])->default('Theory');
            $table->string('subject_code');
            $table->unsignedTinyInteger('credits')->default(0);
            $table->unsignedSmallInteger('internal_marks')->default(0);
            $table->unsignedSmallInteger('external_marks')->default(0);
            $table->unsignedSmallInteger('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
