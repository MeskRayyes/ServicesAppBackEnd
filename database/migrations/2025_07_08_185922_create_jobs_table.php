<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('jobs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->string('category');
    $table->enum('job_type', ['Full Time', 'Part Time', 'Freelance']);
    $table->enum('work_place', ['On Site', 'Remote', 'Hybrid']);
    $table->string('country');
    $table->string('city');
    $table->integer('experience_from');
    $table->integer('experience_to');
    $table->string('salary_range');
    $table->date('deadline');
    $table->timestamps();
});

}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
