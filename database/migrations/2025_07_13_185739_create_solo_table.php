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
        Schema::create('solo', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('full_name');
    $table->integer('age');
    $table->string('gender');
    $table->string('phone');
    $table->string('city');
    $table->string('zip_code');
    $table->string('job_title')->nullable();
    $table->integer('years_of_experience')->nullable();
    $table->string('education_level')->nullable();
    $table->string('preferred_work_nature')->nullable();
    $table->string('skills')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solo');
    }
};
