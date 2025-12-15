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
        Schema::create('course_scheme', function (Blueprint $table) {
            $table->unsignedBigInteger('scheme_id');
            $table->unsignedBigInteger('course_id');
            // foreign keys
            $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            // composite primary key
            $table->primary(['scheme_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_scheme');
    }
};
