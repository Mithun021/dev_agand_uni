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
        Schema::create('course_institutes', function (Blueprint $table) {
            $table->id();
            $table->string('institute', 191)->unique();
            $table->string('city', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('password')->default('123')->change();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('course_institutes', function (Blueprint $table) {
        $table->string('password')->default(null)->change();
    });
        Schema::dropIfExists('course_institutes');
    }
};
